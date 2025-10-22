<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use App\E01DiscountCalculator\Solution\Domain\Model\Order;

interface DiscountRule
{
    /**
     * Checks if the discount rule is applicable to the order.
     */
    public function supports(Order $order): bool;

    /**
     * Calculates the discount based on the order.
     */
    public function calculate(Order $order): float;
}
