<?php

namespace Kollex\Service;

use Kollex\Service\Ingestors\Wholesaler_aIngestor;
use Kollex\Service\Ingestors\Wholesaler_bIngestor;
use PHPUnit\Framework\TestCase;

class IngestorFactoryTest extends TestCase
{

    /**
     * @dataProvider sourceProvider
     * @param $source
     * @param $expected
     */
    public function testGetIngestor($source, $expected)
    {
        $sut = new IngestorFactory();
        $result = $sut->getIngestor($source);
        $this->assertTrue($result == $expected);
    }

    public function sourceProvider()
    {
        return [
            ['Wholesaler_a', new Wholesaler_aIngestor()],
            ['Wholesaler_b', new Wholesaler_bIngestor()],
            ['test', null],
        ];
    }
}
