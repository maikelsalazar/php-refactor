<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class RegularUserDiscountRule implements DiscountRule
{
    public function supports(Order $order): bool
    {
        $user = $order->getUser();

        return $user && !$user->isPremium();
    }

    public function calculate(Order $order): float
    {
        $total = $order->getTotal();

        if ($total > 500) {
            return $total * 0.05;
        }

        return match($order->getCoupon() ?? '') {
            'WELCOME'  => 50,
            'FREESHIP' => $order->getShipping(),
            default    => 0,
        };
    }
}
