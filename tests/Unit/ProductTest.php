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

        $subject = new Product();
        $subject->setId('');
    }
}