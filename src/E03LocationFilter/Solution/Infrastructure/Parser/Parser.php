<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Infrastructure\Parser;

class Parser
{
    public function __construct(private readonly string $separator = ':')
    {

    }

    public function parse(string $encoded): array
    {
        if (strpos($encoded, $this->separator) === false) {
            return [];
        }

        $parts = explode($this->separator, $encoded);
        if (count($parts) === 1) {
            return [$parts[0] => null];
        }

        if (count($parts) === 2) {
            return [$parts[0] => $parts[1]];
        }

        return [];
    }
}
