<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Application;

use App\E03LocationFilter\Solution\Domain\Model\Location;
use App\E03LocationFilter\Solution\Domain\Model\LocationAttribute;
use App\E03LocationFilter\Solution\Domain\Service\LocationAttributeFilter;
use App\E03LocationFilter\Solution\Infrastructure\Parser\LocationAttributeParser;

class LocationFilter
{
    public function __construct(private readonly LocationAttributeParser $parser)
    {

    }

    public function filter(array $locationsData, string $filter): array
    {
        $locations                 = $this->getLocations($locationsData);
        $locationAttributeToFilter = $this->parser->parse($filter);

        $result = [];
        foreach ($locations as $loc) {
            if ($this->matchOne($loc, $locationAttributeToFilter)) {
                $result[] = $loc->toArray();
            }
        }
        return $result;
    }

    public function matchOne(Location $location, LocationAttribute $locationToFilter): bool
    {
        foreach ($location->getAttrs() as $attr) {
            $filter = new LocationAttributeFilter($attr);
            if ($filter->match($locationToFilter)) {
                return true;
            }
        }

        return false;
    }

    private function getLocations(array $locationsData): array
    {
        $locations = [];
        foreach ($locationsData as $data) {
            $locations[] = Location::fromData($data);
        }

        return $locations;
    }
}
