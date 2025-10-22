<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\RegularUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;
use App\E01DiscountCalculator\Solution\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class RegularUserDiscountRuleTest extends TestCase
{
    private DiscountRule $discountRule;

    protected function setUp(): void
    {
        $this->discountRule = new RegularUserDiscountRule();
    }

    public function testItIsCalculatingDiscountOver500(): void
    {
        $order = new Order(1100, 10, 0, null, new User(false));


        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(1100 * 0.05, $this->discountRule->calculate($order));
    }

    public function testItIsCalculatingDiscountUnder500AndUsingWelcomeCoupon(): void
    {
        $order = new Order(490, 10, 0, 'WELCOME', new User(false));

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(50, $this->discountRule->calculate($order));
    }

    public function testItIsCalculatingDiscountUnder500AndUsingFreeShipCoupon(): void
    {
        $order = new Order(490, 10, 0, 'FREESHIP', new User(false));

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(10, $this->discountRule->calculate($order));
    }

    public function testItIsNotSupportingPremiumUser(): void
    {
        $order = new Order(500, 10, 0, null, new User(true));

        $this->assertFalse($this->discountRule->supports($order));
    }

    public function testItIsNotSupportingGuestUser(): void
    {
        $order = new Order(500, 10, 0, null, null);

        $this->assertFalse($this->discountRule->supports($order));
    }

    public function testItReturnsNoDiscountUnder500WithoutCoupon(): void
    {
        $order = new Order(490, 10, 0, null, new User(false));
        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(0, $this->discountRule->calculate($order));
    }
}
