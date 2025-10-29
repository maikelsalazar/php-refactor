<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Exercise;

class LocationFilter
{
    public function filter(array $locations, string $filter): array
    {
        $result = [];
        foreach ($locations as $loc) {
            if ($filter === 'country:MX' && $loc['country'] === 'MX') {
                $result[] = $loc;
            } elseif ($filter === 'city:CDMX' && $loc['city'] === 'CDMX') {
                $result[] = $loc;
            }
        } return $result;
    }
}
