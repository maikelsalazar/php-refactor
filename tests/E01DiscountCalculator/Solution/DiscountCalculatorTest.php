<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution;

use App\E01DiscountCalculator\Solution\DiscountCalculator;
use App\E01DiscountCalculator\Solution\Domain\Discount\DiscountService;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRulesCatalog;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\GuestUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\PremiumUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\RegularUserDiscountRule;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\E01DiscountCalculator\DiscountCalculatorDataProvider;

class DiscountCalculatorTest extends TestCase
{
    private DiscountCalculator $calculator;

    protected function setUp(): void
    {
        $discountService = new DiscountService(
            new DiscountRulesCatalog(
                [
                    new GuestUserDiscountRule(),
                    new RegularUserDiscountRule(),
                    new PremiumUserDiscountRule(),
                ]
            )
        );

        $this->calculator = new DiscountCalculator($discountService);
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'premiumUserOver1000')]
    public function testPremiumUserOver1000(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'premiumUserUnder1000')]
    public function testPremiumUserUnder1000(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'regularUserOver500')]
    public function testRegularUserOver500(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'regularUserUnder500WithWelcomeCoupon')]
    public function testRegularUserUnder500WithWelcomeCoupon(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'regularUserUnder500WithFreeShipping')]
    public function testRegularUserUnder500WithFreeShipping(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'regularUserUnder500WithoutCoupon')]
    public function testRegularUserUnder500WithoutCoupon(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'guestWithDiscount')]
    public function testGuestWithDiscount(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'guestWithDiscountHigherThanTotal')]
    public function testGuestWithDiscountHigherThanTotal(array $order, float $expectedDiscount): void
    {
        // discount cannot exceed total
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }

    #[DataProviderExternal(DiscountCalculatorDataProvider::class, 'noUserNoDiscount')]
    public function testNoUserNoDiscount(array $order, float $expectedDiscount): void
    {
        $this->assertEquals($expectedDiscount, $this->calculator->calculate($order));
    }
}
