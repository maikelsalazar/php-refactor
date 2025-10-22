<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Model;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testItIsBuildingDefault(): void
    {
        $actual = Order::fromData([]);
        $this->assertInstanceOf(Order::class, $actual);

        // no user
        $this->assertNull($actual->getUser(), 'Order with no user');

        // no coupon
        $this->assertNull($actual->getCoupon(), 'Order with no coupon');

        // shipping default
        $this->assertEquals(0.0, $actual->getShipping(), 'Shipping defaults 0');

        // total default
        $this->assertEquals(0.0, $actual->getTotal(), 'Total defaults 0');
    }

    public function testItIsBuildingGuestOrderWithDiscount(): void
    {
        $actual = Order::fromData(['guest_discount' => 50.0]);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertEquals(50.0, $actual->getGuestDiscount());
    }

    public function testItIsBuildingPremiumUser(): void
    {
        $orderData = [
                'user' => [
                    'premium' => true,
                ],
            ];

        $actual = Order::fromData($orderData);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertInstanceOf(User::class, $actual->getUser());
        $this->assertTrue($actual->getUser()->isPremium());

        // Default values

        // no coupon
        $this->assertNull($actual->getCoupon(), 'Order with no coupon');
        // shipping default
        $this->assertEquals(0.0, $actual->getShipping(), 'Shipping defaults 0');
        // total default
        $this->assertEquals(0.0, $actual->getTotal(), 'Total defaults 0');

    }

    public function testItIsBuildingNonPremiumUser(): void
    {
        $orderData = [
            'user' => [
                'premium' => false,
            ],
        ];

        $actual = Order::fromData($orderData);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertInstanceOf(User::class, $actual->getUser());
        $this->assertFalse($actual->getUser()->isPremium());

    }

    public function testItIsBuildingOrderWithCoupon(): void
    {
        $orderData = [
            'coupon'   => 'WELCOME',
        ];

        $actual = Order::fromData($orderData);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertEquals('WELCOME', $actual->getCoupon());
    }

    public function testItIsBuildingOrderWithTotalAndShipping(): void
    {
        $orderData = [
            'total'      => 50.0,
            'shipping'   => 10.0,
        ];

        $actual = Order::fromData($orderData);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertEquals(50.0, $actual->getTotal());
        $this->assertEquals(10.0, $actual->getShipping());

    }

    public function testItIsBuildingFullOrder(): void
    {
        $orderData = [
            'user'           => ['premium' => true],
            'coupon'         => 'WELCOME',
            'total'          => 150.0,
            'shipping'       => 20.0,
            'guest_discount' => 0.0
        ];

        $actual = Order::fromData($orderData);

        $this->assertInstanceOf(Order::class, $actual);
        $this->assertInstanceOf(User::class, $actual->getUser());
        $this->assertTrue($actual->getUser()->isPremium());
        $this->assertEquals('WELCOME', $actual->getCoupon());
        $this->assertEquals(150.0, $actual->getTotal());
        $this->assertEquals(20.0, $actual->getShipping());
        $this->assertEquals(0.0, $actual->getGuestDiscount());

    }
}
