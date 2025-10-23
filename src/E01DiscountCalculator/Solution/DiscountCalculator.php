<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution;

use App\E01DiscountCalculator\Solution\Domain\Discount\DiscountService;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class DiscountCalculator
{
    public function __construct(private readonly DiscountService $discountService)
    {

    }

    public function calculate(array $orderData): float
    {
        $order    = Order::fromData($orderData);
        return $this->discountService->calculate($order);
    }
}
