<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount;

use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRule;
use App\E01DiscountCalculator\Solution\Domain\Discount\Rules\DiscountRulesCatalog;
use App\E01DiscountCalculator\Solution\Domain\Model\Order;

class DiscountService
{
    public function __construct(private readonly DiscountRulesCatalog $discountRules)
    {

    }

    /**
     * Calculate the discount for an order using the discount rules catalog.
     * Only the first matching discount rule will be applied.
     */
    public function calculate(Order $order): float
    {
        /** @var DiscountRule $discountRule */
        foreach ($this->discountRules as $discountRule) {
            if ($discountRule->supports($order)) {
                return min($discountRule->calculate($order), $order->getTotal());
            }
        }

        return 0.0;
    }
}
