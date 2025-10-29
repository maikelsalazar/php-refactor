<?php

declare(strict_types=1);

namespace App\E03LocationFilter\Solution\Infrastructure\Parser;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    private Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testParseString(): void
    {
        $result = $this->parser->parse('country:MX');

        $keysExpected   = ['country'];
        $valuesExpected = ['MX'];

        $this->assertEquals(1, count($result));
        $this->assertEquals($keysExpected, array_keys($result));
        $this->assertEquals($valuesExpected, array_values($result));
    }

    public function testParseStringWithOneElement(): void
    {
        $result = $this->parser->parse('country:');

        $keysExpected   = ['country'];
        $valuesExpected = [null];

        $this->assertEquals(1, count($result));
        $this->assertEquals($keysExpected, array_keys($result));
        $this->assertEquals($valuesExpected, array_values($result));
    }

    public function testParseStringWithNoElement(): void
    {
        $result = $this->parser->parse('');
        $this->assertEquals(0, count($result));
    }

    public function testParseStringWithNoSeparator(): void
    {
        $result = $this->parser->parse('country');
        $this->assertEquals(0, count($result));
    }

    public function testParseStringWithMoreThanOneSeparator(): void
    {
        $result = $this->parser->parse('country:MX:CDMX');
        $this->assertEquals(0, count($result));
    }
}
