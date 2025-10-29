<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Infrastructure\Parser;

use App\E03LocationFilter\Solution\Domain\Model\LocationAttribute;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class LocationAttributeParserTest extends TestCase
{
    private LocationAttributeParser $parser;

    protected function setUp(): void
    {
        $this->parser = new LocationAttributeParser(new Parser());
    }

    public function testParseLocationAttribute(): void
    {
        $countryAttr = $this->parser->parse('country:MX');

        $this->assertInstanceOf(LocationAttribute::class, $countryAttr);
        $this->assertSame('country', $countryAttr->getKey());
        $this->assertSame('MX', $countryAttr->getValue());


        $cityAttr = $this->parser->parse('city:CDMX');

        $this->assertInstanceOf(LocationAttribute::class, $cityAttr);
        $this->assertSame('city', $cityAttr->getKey());
        $this->assertSame('CDMX', $cityAttr->getValue());
    }

    public function testDoesNotParseLocationAttribute(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->parser->parse('country');
    }
}
