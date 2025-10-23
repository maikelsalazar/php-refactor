<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\PremiumUserDiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;
use App\E01DiscountCalculator\Solution\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class PremiumUserDiscountRuleTest extends TestCase
{
    private DiscountRule $discountRule;

    protected function setUp(): void
    {
        $this->discountRule = new PremiumUserDiscountRule();
    }

    public function testCalculatesDiscountOver1000ForPremiumUser(): void
    {
        $order = new Order(1100, 10, 0, null, new User(true));

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(1100 * 0.2, $this->discountRule->calculate($order));
    }

    public function testCalculatesDiscountExactly1000ForPremiumUser(): void
    {
        $order = new Order(1000, 10, 0, null, new User(true));

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(1000 * 0.1, $this->discountRule->calculate($order));
    }

    public function testCalculatesDiscountUnder1000ForPremiumUser(): void
    {
        $order = new Order(500, 10, 0, null, new User(true));

        $this->assertTrue($this->discountRule->supports($order));
        $this->assertEquals(500 * 0.1, $this->discountRule->calculate($order));
    }

    public function testDoesNotSupportNonPremiumUser(): void
    {
        $order = new Order(500, 10, 0, null, new User(false));

        $this->assertFalse($this->discountRule->supports($order));
    }

    public function testDoesNotSupportGuestUser(): void
    {
        $order = new Order(500, 10, 0, null, null);

        $this->assertFalse($this->discountRule->supports($order));
    }
}
