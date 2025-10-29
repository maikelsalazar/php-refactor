<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Exercise;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\E03LocationFilter\LocationFilterDataProvider;

final class LocationFilterTest extends TestCase
{
    #[DataProviderExternal(LocationFilterDataProvider::class, 'filterProvider')]
    public function testFilter(array $locations, string $filterString, array $expected): void
    {
        $filter = new LocationFilter();
        $result = $filter->filter($locations, $filterString);

        $this->assertEquals($expected, array_values($result));
    }
}
