<?php

namespace Unit;

use Kollex\Assortment\ProductInterface;
use Kollex\Filesystem\CsvFileReader;
use PHPUnit\Framework\TestCase;

class CsvFileReaderTest extends TestCase
{
    public function testRead(): void
    {
        $content =  <<<CSV
            id;ean;manufacturer;product;description;packaging product;foo;packaging unit;amount per unit;items on stock (availability);warehouse
            12345600001;23880602029774;Drinks Corp.;Soda Drink, 12 * 1,0l;Lorem ipsum usu amet dicat nullam ea;case 12;bar;bottle;1.0l;123;north
            CSV;

        $csv = tempnam(sys_get_temp_dir(), 'wholesaler_');
        file_put_contents($csv, $content);

        $subject = new CsvFileReader();
        $products = iterator_to_array($subject->read($csv));

        /** @var ProductInterface $product */
        $product = $products[0];

        $this->assertCount(1, $products);
        $this->assertEquals('12345600001', $product->getId());
        $this->assertEquals('23880602029774', $product->getGtin());
        $this->assertEquals('Drinks Corp.', $product->getManufacturer());
    }

    /**
     * @dataProvider filenameDataProvider
     */
    public function testSupports(string $filepath, bool $expected): void
    {
        $subject = new CsvFileReader();

        $this->assertEquals($expected, $subject->supports($filepath));
    }

    public function filenameDataProvider()
    {
        yield ['wholesaler_a.csv', true];
        yield ['wholesaler_b.json', false];
        yield ['wholesaler_b.csv', false];
        yield ['wholesaler_a.json', false];
    }
}