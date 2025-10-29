<?php

declare(strict_types=1);

namespace Tests\E03LocationFilter;

class LocationFilterDataProvider
{
    public const LOCATIONS = [
            ['country' => 'MX', 'city' => 'CDMX'],
            ['country' => 'MX', 'city' => 'Monterrey'],
            ['country' => 'US', 'city' => 'New York'],
            ['country' => 'US', 'city' => 'Los Angeles'],
        ];

    public static function filterProvider(): array
    {
        return [
            'filter country MX' => [
                'locations'    => self::LOCATIONS,
                'filterString' => 'country:MX',
                'expected'     => [
                    ['country' => 'MX', 'city' => 'CDMX'],
                    ['country' => 'MX', 'city' => 'Monterrey'],
                ],
            ],
            'filter city CDMX' => [
                'locations'    => self::LOCATIONS,
                'filterString' => 'city:CDMX',
                'expected'     => [
                    ['country' => 'MX', 'city' => 'CDMX'],
                ],
            ],
            'filter country US' => [
                'locations'    => self::LOCATIONS,
                'filterString' => 'country:US',
                'expected'     => [], // exercise version does not handle
            ],
            'filter city Monterrey' => [
                'locations'    => self::LOCATIONS,
                'filterString' => 'city:Monterrey',
                'expected'     => [], // exercise version does not handle
            ],
            'filter unknown' => [
                'locations'    => self::LOCATIONS,
                'filterString' => 'country:BR',
                'expected'     => [], // no match
            ],
        ];
    }
}
