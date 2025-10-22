<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator;

use App\E01DiscountCalculator\DiscountCalculator;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class DiscountCalculatorTest extends TestCase
{
    private DiscountCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new DiscountCalculator();
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
