<?php

namespace Unit;

use Kollex\Assortment\ProductInterface;
use Kollex\Filesystem\JsonFileReader;
use PHPUnit\Framework\TestCase;

class JsonFileReaderTest extends TestCase
{
    public function testRead(): void
    {
        $json = tempnam(sys_get_temp_dir(), 'wholesaler_');
        file_put_contents($json, json_encode(
            [
                'data' => [
                    [
                        "PRODUCT_IDENTIFIER" => "12345600001",
                          "EAN_CODE_GTIN" => "24880602029766",
                          "BRAND" => "Drinks Corp.",
                          "NAME" => "Soda Drink, 12x 1L",
                          "PACKAGE"=>  "case",
                          "ADDITIONAL_INFO"=>  "",
                          "VESSEL"=>  "bottle",
                          "LITERS_PER_BOTTLE"=>  "1",
                          "BOTTLE_AMOUNT" => "12"
                    ]
                ]
            ]
        ));

        $subject = new JsonFileReader();
        $products = iterator_to_array($subject->read($json));

        /** @var ProductInterface $product */
        $product = $products[0];

        $this->assertCount(1, $products);
        $this->assertEquals('12345600001', $product->getId());
    }

    /**
     * @dataProvider filenameDataProvider
     */
    public function testSupports(string $filepath, bool $expected): void
    {
        $subject = new JsonFileReader();

        $this->assertEquals($expected, $subject->supports($filepath));
    }

    public function filenameDataProvider(): iterable
    {
        yield ['wholesaler_a.csv', false];
        yield ['wholesaler_b.json', true];
        yield ['wholesaler_b.csv', false];
        yield ['wholesaler_a.json', false];
    }
}