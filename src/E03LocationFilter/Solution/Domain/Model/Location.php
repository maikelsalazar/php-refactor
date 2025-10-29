<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Domain\Model;

use InvalidArgumentException;

class Location
{
    /** @var array<string, LocationAttribute> */
    private array $attrs;

    public function __construct(
        array $attrs
    ) {
        foreach ($attrs as $attr) {
            if (!$attr instanceof LocationAttribute) {
                throw new InvalidArgumentException('Only LocationAttribute instances allowed');
            }

            $this->attrs[$attr->getKey()] = $attr;
        }
    }

    public function getAttrs(): array
    {
        return $this->attrs;
    }

    public function toArray(): array
    {
        $rawLocation = [];
        foreach ($this->attrs as $attr) {
            $rawLocation[$attr->getKey()] = $attr->getValue();
        }

        return $rawLocation;
    }

    public static function fromData(array $locationData): self
    {
        $attrs = [];
        foreach ($locationData as $key => $value) {
            $attrs[] = new LocationAttribute($key, $value);
        }

        return new self($attrs);
    }
}
