<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Discount\Rules;

use IteratorAggregate;
use Traversable;

class DiscountRulesCatalog implements IteratorAggregate
{
    /** @var DiscountRule[] */
    private readonly array $rules;

    /**
     * @param DiscountRule[] $rules
     */
    public function __construct(array $rules)
    {
        foreach ($rules as $rule) {
            if (!$rule instanceof DiscountRule) {
                throw new \InvalidArgumentException('All items must implement DiscountRule');
            }
        }

        $this->rules = $rules;
    }

    public function getIterator(): Traversable
    {
        yield from $this->rules;
    }
}
