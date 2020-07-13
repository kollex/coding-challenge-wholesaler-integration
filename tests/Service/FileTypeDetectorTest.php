<?php

namespace Kollex\Service;

use PHPUnit\Framework\TestCase;

class FileTypeDetectorTest extends TestCase
{

    /**
     * @dataProvider fileNameProvider
     * @param string $filename
     * @param string $expected
     */
    public function testGetType(string $filename, string $expected)
    {
        $sut = new FileTypeDetector();
        $this->assertTrue($expected == $sut->getType($filename));
    }

    public function fileNameProvider()
    {
        return [
            ['test', ''],
            ['test.xls', ''],
            ['', ''],
            ['test.json', 'json'],
            ['test.csv', 'csv'],
            ['test.file.csv', 'csv'],
            ['test..file.csv', 'csv'],
            ['.csv', ''],
        ];
    }

    /**
     * @dataProvider nameProvider
     * @param string $filename
     * @param string $expected
     */
    public function testGetName(string $filename, string $expected)
    {
        $sut = new FileTypeDetector();
        $this->assertTrue($expected == $sut->getName($filename));
    }

    public function nameProvider()
    {
        return [
            ['test', 'test'],
            ['test.xls', 'test'],
            ['', ''],
            ['test.json', 'test'],
            ['test.csv', 'test'],
            ['test.file.csv', 'test.file'],
            ['test..file.csv', 'test..file'],
            ['.csv', '.csv'],
        ];
    }
}
