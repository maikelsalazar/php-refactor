<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class GuestUserDiscountRule implements DiscountRule
{
    public function supports(Order $order): bool
    {
        return !$order->getUser();
    }

    public function calculate(Order $order): float
    {
        return $order->getGuestDiscount();
    }
}
