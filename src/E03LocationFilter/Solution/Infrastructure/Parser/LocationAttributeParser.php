<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Infrastructure\Parser;

use App\E03LocationFilter\Solution\Domain\Model\LocationAttribute;
use InvalidArgumentException;

class LocationAttributeParser
{
    public function __construct(private readonly Parser $parser)
    {

    }

    public function parse(string $encoded): LocationAttribute
    {
        $decoded = $this->parser->parse($encoded);
        if (count($decoded) === 1) {
            return new LocationAttribute(key($decoded), current($decoded));
        }

        throw new InvalidArgumentException('Invalid string to parse');
    }
}
