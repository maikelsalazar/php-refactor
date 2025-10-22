<?php

declare(strict_types=1);

namespace Tests\E01DiscountCalculator;

class DiscountCalculatorDataProvider
{
    public static function premiumUserOver1000(): array
    {
        $order = [
            'user'  => ['is_premium' => true],
            'total' => 1500,
        ];

        $expected = 1500 * 0.2;

        return [
            [$order, $expected],
        ];
    }

    public static function premiumUserUnder1000(): array
    {
        $order = [
            'user'  => ['is_premium' => true],
            'total' => 800,
        ];

        $expected = 800 * 0.1;

        return [
            [$order, $expected],
        ];
    }

    public static function regularUserOver500(): array
    {
        $order = [
            'user'  => ['is_premium' => false],
            'total' => 600,
        ];

        $expected = 600 * 0.05;

        return [
            [$order, $expected],
        ];
    }

    public static function regularUserUnder500WithWelcomeCoupon(): array
    {
        $order = [
            'user'   => ['is_premium' => false],
            'total'  => 400,
            'coupon' => 'WELCOME',
        ];

        $expected = 50;

        return [
            [$order, $expected],
        ];
    }

    public static function regularUserUnder500WithFreeShipping(): array
    {
        $order = [
            'user'     => ['is_premium' => false],
            'total'    => 400,
            'coupon'   => 'FREESHIP',
            'shipping' => 30,
        ];

        $expected = 30;

        return [
            [$order, $expected],
        ];
    }

    public static function regularUserUnder500WithoutCoupon(): array
    {
        $order = [
            'user'  => ['is_premium' => false],
            'total' => 400,
        ];

        $expected = 0;

        return [
            [$order, $expected],
        ];
    }

    public static function guestWithDiscount(): array
    {
        $order = [
            'total'          => 200,
            'guest_discount' => 50,
        ];

        $expected = 50;

        return [
            [$order, $expected],
        ];
    }

    public static function guestWithDiscountHigherThanTotal(): array
    {
        $order = [
            'total'          => 40,
            'guest_discount' => 100,
        ];

        $expected = 40;

        return [
            [$order, $expected],
        ];
    }

    public static function noUserNoDiscount(): array
    {
        $order = [
            'total' => 200,
        ];

        $expected = 0;

        return [
            [$order, $expected],
        ];
    }
}
