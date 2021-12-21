<?php

namespace Unit;

use Assert\InvalidArgumentException;
use Kollex\Assortment\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testIdRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setId('');
    }

    public function testManufacturerRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setManufacturer('');
    }

    public function testNameRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setName('');
    }

    public function testPackagingRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setPackaging(null);
    }

    public function testBaseProductPackagingRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setBaseProductPackaging(null);
    }

    public function testBaseProductUnitRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setBaseProductUnit(null);
    }

    public function testBaseProductAmountRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setBaseProductAmount(null);
    }

    public function testBaseProductQuantityRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->product()->setBaseProductQuantity(null);
    }

    private function product(): Product
    {
        return new Product();
    }
}