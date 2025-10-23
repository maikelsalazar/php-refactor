<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\GuestUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;
use App\E01DiscountCalculator\Solution\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class GuestUserDiscountRuleTest extends TestCase
{
    private DiscountRule $discountRule;

    protected function setUp(): void
    {
        $this->discountRule = new GuestUserDiscountRule();
    }

    public function testItIsCalculatingGuesDiscount(): void
    {
        $order = new Order(100, 10, 15, null, null);

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(15, $this->discountRule->calculate($order));
    }

    public function testItIsHavingNoDiscountWhenGuesDiscountIsNotProvided(): void
    {
        $order = new Order(100, 10, 0, null, null);

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(0, $this->discountRule->calculate($order));
    }

    public function testItIsNotSupportingGuesDiscountWhenThereIsAnUser(): void
    {
        $order = new Order(100, 10, 15, null, new User(false));

        $this->assertFalse($this->discountRule->supports($order));
    }
}
