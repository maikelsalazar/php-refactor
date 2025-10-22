<?php

declare(strict_types=1);

namespace App\E01DiscountCalculator\Solution\Domain\Model;

class User
{
    public function __construct(private readonly bool $premium)
    {

    }

    public function isPremium(): bool
    {
        return $this->premium;
    }

    public static function fromData(array $userData): self
    {
        return new self(
            isset($userData['premium'])
            && is_bool($userData['premium'])
            && $userData['premium']
        );
    }
}
