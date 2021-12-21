<?php

namespace Unit;

use Kollex\Assortment\Product;
use Kollex\Filesystem\DirectoryDataProvider;
use Kollex\Filesystem\FileReaderInterface;
use PHPUnit\Framework\TestCase;

class DirectoryDataProviderTest extends TestCase
{
    public function testGetProducts(): void
    {
        $reader = $this->createMock(FileReaderInterface::class);

        $reader->method('supports')
            ->willReturn(true);

        $reader->expects($this->exactly(2))
            ->method('read')
            ->willReturnCallback(static fn () => yield new Product());

        $subject = new DirectoryDataProvider(__DIR__ . '/../../data', $reader);
        $subject->getProducts();
    }
}
