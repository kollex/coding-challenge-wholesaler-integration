<?php

namespace Kollex\Service;

use PHPUnit\Framework\TestCase;

class MeasurementDetectorTest extends TestCase
{

    /**
     * @dataProvider packageProvider
     * @param string $package
     * @param $expected
     */
    public function testGetMeasure(string $package, $expected)
    {
        $sut = new MeasurementDetector();
        $result = $sut->getMeasure($package);
        $this->assertTrue($expected == $result);
    }

    /**
     * @dataProvider quantityProvider
     * @param string $package
     * @param $expected
     */
    public function testGetQuantity(string $package, $expected)
    {
        $sut = new MeasurementDetector();
        $result = $sut->getQuantity($package);
        $this->assertTrue($expected === $result);
    }

    public function packageProvider()
    {
        return [
            ['0.5l', 'LT'],
            ['12l', 'LT'],
            ['12g', 'GR'],
            ['11liters', ''],
            ['1liter', ''],
            ['1 liter', ''],
        ];
    }

    public function quantityProvider()
    {
        return [
            ['0.5l', 0.5],
            ['12l', 12.0],
            ['12g', 12.0],
            ['11liters', 0.0],
            ['1liter', 0.0],
            ['1 liter', 0.0],
        ];
    }
}
