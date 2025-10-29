<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Domain\Service;

use App\E03LocationFilter\Solution\Domain\Model\LocationAttribute;

class LocationAttributeFilter
{
    public function __construct(
        private readonly LocationAttribute $locationAttribute
    ) {

    }

    public function match(LocationAttribute $other): bool
    {
        return $this->locationAttribute->equals($other);
    }
}
