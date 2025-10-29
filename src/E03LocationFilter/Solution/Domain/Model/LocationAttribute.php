<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Domain\Model;

class LocationAttribute
{
    public function __construct(
        private readonly string $key,
        private readonly string $value,
    ) {

    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [$this->key => $this->value];
    }

    public function equals(self $other): bool
    {
        return $this->key       === $other->getKey()
                && $this->value === $other->getValue();
    }
}
