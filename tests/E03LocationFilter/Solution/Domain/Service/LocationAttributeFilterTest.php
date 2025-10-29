<?php


declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Domain\Service;

use App\E03LocationFilter\Solution\Domain\Model\LocationAttribute;
use PHPUnit\Framework\TestCase;

class LocationAttributeFilterTest extends TestCase
{
    private LocationAttributeFilter $filter;

    protected function setUp(): void
    {
        $countryLocation = new LocationAttribute('country', 'MX');

        $this->filter = new LocationAttributeFilter($countryLocation);
    }

    public function testMatch(): void
    {
        $this->assertTrue($this->filter->match(new LocationAttribute('country', 'MX')));
    }

    public function testDoesNotMatch(): void
    {
        $this->assertFalse($this->filter->match(new LocationAttribute('country', 'US')));
        $this->assertFalse($this->filter->match(new LocationAttribute('city', 'CDMX')));

    }
}
