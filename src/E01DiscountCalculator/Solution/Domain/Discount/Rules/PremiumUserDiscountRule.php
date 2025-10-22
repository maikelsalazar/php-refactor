<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class PremiumUserDiscountRule implements DiscountRule
{
    public function supports(Order $order): bool
    {
        $user = $order->getUser();

        return $user && $user->isPremium();
    }

    public function calculate(Order $order): float
    {
        $total = $order->getTotal();

        return $total > 1000
                ? $total * 0.2
                : $total * 0.1;
    }
}
