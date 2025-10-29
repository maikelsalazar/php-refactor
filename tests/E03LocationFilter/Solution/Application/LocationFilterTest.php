<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Application;

use App\E03LocationFilter\Solution\Infrastructure\Parser\LocationAttributeParser;
use App\E03LocationFilter\Solution\Infrastructure\Parser\Parser;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\E03LocationFilter\LocationFilterDataProvider;

final class LocationFilterTest extends TestCase
{
    #[DataProviderExternal(LocationFilterDataProvider::class, 'filterProviderSolution')]
    public function testFilter(array $locations, string $filterString, array $expected): void
    {
        $filter = new LocationFilter(
            new LocationAttributeParser(new Parser())
        );
        $result = $filter->filter($locations, $filterString);

        $this->assertEquals($expected, array_values($result));
    }
}
