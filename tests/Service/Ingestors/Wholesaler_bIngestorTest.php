<?php

namespace Kollex\Service\Ingestors;

use Kollex\Dataprovider\Assortment\AssortmentProduct;
use PHPUnit\Framework\TestCase;

class Wholesaler_bIngestorTest extends TestCase
{

    /**
     * @dataProvider productDataProvider
     * @param array $data
     */
    public function testParseRowsIntoProducts(array $data)
    {
        $sut = new Wholesaler_bIngestor();
        $product = $sut->parseRowsIntoProducts($data);

        $this->assertTrue($product instanceof AssortmentProduct);
    }

    public function productDataProvider()
    {
        return [
            ['base case 0' => [
                "PRODUCT_IDENTIFIER" => "12345600001",
                "EAN_CODE_GTIN" => "24880602029766",
                "BRAND" => "Drinks Corp.",
                "NAME" => "Soda Drink, 12x 1L",
                "PACKAGE" => "case",
                "ADDITIONAL_INFO" => "",
                "VESSEL" => "bottle",
                "LITERS_PER_BOTTLE" => "1",
                "BOTTLE_AMOUNT" => "12"
            ],],
            ['base case 1' => [
                "PRODUCT_IDENTIFIER" => "12345600002",
                "EAN_CODE_GTIN" => "24880602029773",
                "BRAND" => "Drinks Corp.",
                "NAME" => "Orange Drink, 20x 0.5L",
                "PACKAGE" => "case",
                "ADDITIONAL_INFO" => "",
                "VESSEL" => "bottle",
                "LITERS_PER_BOTTLE" => "0,5",
                "BOTTLE_AMOUNT" => "20"
            ],],
        ];
    }
}
