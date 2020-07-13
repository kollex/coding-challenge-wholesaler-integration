<?php

namespace Kollex\Service\Ingestors;

use Kollex\Dataprovider\Assortment\AssortmentProduct;
use PHPUnit\Framework\TestCase;

class Wholesaler_aIngestorTest extends TestCase
{

    /**
     * @dataProvider productDataProvider
     * @param array $data
     */
    public function testParseRowsIntoProducts(array $data)
    {
        $sut = new Wholesaler_aIngestor();
        $product = $sut->parseRowsIntoProducts($data);

        $this->assertTrue($product instanceof AssortmentProduct);
    }

    public function productDataProvider()
    {
        return [
            ['base case 0' => [
                '12345600001',
                '23880602029774',
                'Drinks Corp.',
                'Soda Drink, 12 * 1,0l',
                'Lorem ipsum usu amet dicat nullam ea',
                'case 12',
                'bar',
                'bottle',
                '1.0l',
                '123',
                'north',
            ],],
            ['base case 1' => [
                '12345600002',
                '23880602029781',
                'Drinks Corp.',
                'Orange Drink, 20 * 0,5l',
                'Viris imperdiet forensibus ius ei',
                'case 20',
                'bar',
                'bottle',
                '0.5l',
                '234',
                'north',
            ],],
        ];
    }
}
