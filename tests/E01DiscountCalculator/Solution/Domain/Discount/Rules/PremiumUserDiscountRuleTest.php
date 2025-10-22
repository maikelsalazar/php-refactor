<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\PremiumUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;
use App\E01DiscountCalculator\Solution\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class PremiumUserDiscountRuleTest extends TestCase
{
    public function testItIsCalculatingDiscountOver1000(): void
    {
        $order = new Order(1100, 10, 0, null, new User(true));

        $premiumRule = new PremiumUserDiscountRule();

        $this->assertTrue($premiumRule->supports($order));
        $this->assertEquals(1100 * 0.2, $premiumRule->calculate($order));
    }

    public function testItIsCalculatingDiscountUnder1000(): void
    {
        $order = new Order(500, 10, 0, null, new User(true));

        $premiumRule = new PremiumUserDiscountRule();

        $this->assertTrue($premiumRule->supports($order));
        $this->assertEquals(500 * 0.1, $premiumRule->calculate($order));
    }

    public function testItIsNotSupportingNonPremiumUser(): void
    {
        $order = new Order(500, 10, 0, null, new User(false));

        $premiumRule = new PremiumUserDiscountRule();

        $this->assertFalse($premiumRule->supports($order));
    }

    public function testItIsNotSupportingGuestUser(): void
    {
        $order = new Order(500, 10, 0, null, null);

        $premiumRule = new PremiumUserDiscountRule();

        $this->assertFalse($premiumRule->supports($order));
    }
}
