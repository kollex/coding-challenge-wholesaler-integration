<?php

namespace Kollex\Service;

use Kollex\Service\Parsers\CsvParser;
use Kollex\Service\Parsers\JsonParser;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{
    /**
     * @dataProvider sourceProvider
     * @param $source
     * @param $expected
     */
    public function testGetIngestor($source, $expected)
    {
        $sut = new ParserFactory();
        $result = $sut->getParser($source);
        $this->assertTrue($result == $expected);
    }

    public function sourceProvider()
    {
        return [
            ['json', new JsonParser()],
            ['csv', new CsvParser()],
            ['test', null],
        ];
    }
}
