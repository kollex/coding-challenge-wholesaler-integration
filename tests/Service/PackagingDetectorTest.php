<?php

namespace Kollex\Service;

use PHPUnit\Framework\TestCase;

class PackagingDetectorTest extends TestCase
{

    /**
     * @dataProvider packageProvider
     * @param string $package
     * @param $expected
     */
    public function testGetPackaging(string $package, $expected)
    {
        $fallback = 'bottle';
        $sut = new PackagingDetector();
        $result = $sut->getPackaging($package, $fallback);
        $this->assertTrue($result == $expected);
    }

    public function packageProvider()
    {
        return [
            ['case 12', 'CA'],
            ['box 8', 'BX'],
            ['bottle', 'BO'],
            ['can 6', 'CN'],
            ['single', 'BO'],
            [' ', 'Unknown'],
        ];
    }

    /**
     * @dataProvider unitsProvider
     * @param string $package
     * @param $expected
     */
    public function testGetPackageUnits(string $package, $expected)
    {
        $sut = new PackagingDetector();
        $result = $sut->getPackageUnits($package);
        $this->assertTrue($result == $expected);
    }

    public function unitsProvider()
    {
        return [
            ['case 12', 12],
            ['box 8', 8],
            ['bottle', 0],
            ['can 6', 6],
            ['single', 1],
            [' ', 0],
        ];
    }
}
