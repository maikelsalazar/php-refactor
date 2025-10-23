<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution\Domain\Discount;

use App\E01DiscountCalculator\Solution\Domain\Discount\DiscountService;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRulesCatalog;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\GuestUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\PremiumUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\RegularUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;
use App\E01DiscountCalculator\Solution\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    private DiscountService $service;

    protected function setUp(): void
    {
        $rulesCatalog = new DiscountRulesCatalog([
            new PremiumUserDiscountRule(),
            new RegularUserDiscountRule(),
            new GuestUserDiscountRule(),
        ]);

        $this->service = new DiscountService($rulesCatalog);
    }

    // -------------------- Premium Users --------------------
    public function testPremiumUserOver1000(): void
    {
        $order = new Order(1500, 20, 0, null, new User(true));
        $this->assertEquals(1500 * 0.2, $this->service->calculate($order));
    }

    public function testPremiumUserUnder1000(): void
    {
        $order = new Order(800, 20, 0, null, new User(true));
        $this->assertEquals(800 * 0.1, $this->service->calculate($order));
    }

    // -------------------- Regular Users --------------------
    public function testRegularUserOver500(): void
    {
        $order = new Order(600, 15, 0, null, new User(false));
        $this->assertEquals(600 * 0.05, $this->service->calculate($order));
    }

    public function testRegularUserUnder500WithWelcomeCoupon(): void
    {
        $order = new Order(400, 10, 0, 'WELCOME', new User(false));
        $this->assertEquals(50, $this->service->calculate($order));
    }

    public function testRegularUserUnder500WithFreeShipCoupon(): void
    {
        $order = new Order(400, 10, 0, 'FREESHIP', new User(false));
        $this->assertEquals(10, $this->service->calculate($order));
    }

    public function testRegularUserUnder500WithoutCoupon(): void
    {
        $order = new Order(400, 10, 0, null, new User(false));
        $this->assertEquals(0, $this->service->calculate($order));
    }

    // -------------------- Guest Users --------------------
    public function testGuestWithDiscount(): void
    {
        $order = new Order(200, 10, 50, null, null);
        $this->assertEquals(50, $this->service->calculate($order));
    }

    public function testGuestWithDiscountHigherThanTotal(): void
    {
        $order = new Order(40, 5, 100, null, null);
        $this->assertEquals(40, $this->service->calculate($order)); // capped at total
    }

    public function testGuestWithoutDiscount(): void
    {
        $order = new Order(100, 10, 0, null, null);
        $this->assertEquals(0, $this->service->calculate($order));
    }

    // -------------------- Catalog Order / Priority --------------------
    public function testFirstMatchingRuleAppliedOnly(): void
    {
        $rulesCatalog = new DiscountRulesCatalog([
            new GuestUserDiscountRule(), // guest first
            new PremiumUserDiscountRule(),
        ]);
        $service = new DiscountService($rulesCatalog);

        $order = new Order(1200, 20, 0, null, new User(true));
        // Premium user matches second rule, but service applies first matching rule (guest) → does not match → should still apply premium
        $this->assertEquals(1200 * 0.2, $service->calculate($order));
    }

    // -------------------- Edge Cases --------------------
    public function testEmptyCatalogReturnsZero(): void
    {
        $service = new DiscountService(new DiscountRulesCatalog([]));
        $order   = new Order(500, 10, 0, null, new User(true));
        $this->assertEquals(0, $service->calculate($order));
    }

    public function testUnknownCouponReturnsZero(): void
    {
        $order = new Order(300, 10, 0, 'INVALID', new User(false));
        $this->assertEquals(0, $this->service->calculate($order));
    }

    public function testZeroTotalReturnsZero(): void
    {
        $order = new Order(0, 10, 50, null, null);
        $this->assertEquals(0, $this->service->calculate($order));
    }
}
