<?php

namespace Kollex\Service\Parsers;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class CsvParserTest extends TestCase
{
    public $root; // mock filesystem

    public function setUp(): void
    {
        $structure = [
            'csv' => [
                'input.csv' => "id;ean;manufacturer;product;description;packaging product;foo;packaging unit;amount per ".
                    "unit;items on stock (availability);warehouse\n12345600001;23880602029774;Drinks Corp.;Soda Drink,".
                    " 12 * 1,0l;Lorem ipsum usu amet dicat nullam ea;case 12;bar;bottle;1.0l;123;north\n".
                    "12345600002;23880602029781;Drinks Corp.;Orange Drink, 20 * 0,5l;Viris imperdiet forensibus ius ei".
                    ";case 20;baz;bottle;0.5l;234;north"
            ]
        ];

        $this->root = vfsStream::setup('root',null, $structure);
    }

    public function testParseFile()
    {
        $sut = new CsvParser();
        $result = $sut->parseFile($this->root->url() . '/csv/input.csv');

        $this->assertTrue($result instanceof \Generator);
    }
}
