<?php

namespace Unit;

use Kollex\Assortment\BaseProductUnitType;
use PHPUnit\Framework\TestCase;

class BaseProductUnitTypeTest extends TestCase
{
    /**
     * @dataProvider validPackagingDataProvider
     */
    public function testResolve(string $type, BaseProductUnitType $expected): void
    {
        $this->assertEquals($expected, BaseProductUnitType::resolve($type));
    }

    public function validPackagingDataProvider()
    {
        yield ['2l', BaseProductUnitType::LT];
        yield ['4.0l', BaseProductUnitType::LT];
        yield ['2,1l', BaseProductUnitType::LT];
        yield ['200g', BaseProductUnitType::GR];
    }

    /**
     * @dataProvider validAmountProvider
     */
    public function testAmount(string $amount, float $expected): void
    {
        $this->assertEquals($expected, BaseProductUnitType::amount($amount));
    }

    public function validAmountProvider()
    {
        yield ['2l', 2.0];
        yield ['4.0l', 4.0];
        yield ['2,1l', 2.1];
        yield ['200g', 200];
    }
}
