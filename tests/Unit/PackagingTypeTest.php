<?php

namespace Unit;

use Kollex\Assortment\PackagingType;
use PHPUnit\Framework\TestCase;

class PackagingTypeTest extends TestCase
{
    /**
     * @dataProvider validPackagingDataProvider
     */
    public function testResolve(string $type, PackagingType $expected): void
    {
        $this->assertEquals($expected, PackagingType::resolve($type));
    }

    public function validPackagingDataProvider()
    {
        yield ['bottle', PackagingType::BO];
        yield ['box', PackagingType::BX];
        yield ['box 6', PackagingType::BX];
        yield ['case', PackagingType::CA];
        yield ['case 12', PackagingType::CA];
        yield ['case 20', PackagingType::CA];
    }

    /**
     * @dataProvider invalidPackagingDataProvider
     */
    public function testInvalidResolve(string $type): void
    {
        $this->expectException(\InvalidArgumentException::class);
        PackagingType::resolve($type);
    }

    public function invalidPackagingDataProvider()
    {
        yield ['single'];
        yield ['tray'];
    }
}