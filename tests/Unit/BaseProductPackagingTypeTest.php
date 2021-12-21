<?php

namespace Unit;

use Kollex\Assortment\BaseProductPackagingType;
use PHPUnit\Framework\TestCase;

final class BaseProductPackagingTypeTest extends TestCase
{
    /**
     * @dataProvider validPackagingDataProvider
     */
    public function testResolve(string $type, BaseProductPackagingType $expected): void
    {
        $this->assertEquals($expected, BaseProductPackagingType::resolve($type));
    }

    public function validPackagingDataProvider()
    {
        yield ['bottle', BaseProductPackagingType::BO];
        yield ['can', BaseProductPackagingType::CN];
    }

    /**
     * @dataProvider invalidPackagingDataProvider
     */
    public function testInvalid(string $type): void
    {
        $this->expectException(\UnhandledMatchError::class);
        BaseProductPackagingType::resolve($type);
    }

    public function invalidPackagingDataProvider()
    {
        yield ['package'];
        yield ['envelope'];
    }
}
