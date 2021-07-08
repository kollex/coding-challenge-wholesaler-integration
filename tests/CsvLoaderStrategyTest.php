<?php

namespace Tests;

use Kollex\Assortment\ProductInterface;
use Kollex\DataProvider\Strategies\CsvLoaderStrategy;
use PHPUnit\Framework\TestCase;

class CsvLoaderStrategyTest extends TestCase
{
    use bootstrapApp;

    protected function setUp(): void
    {
        $this->initApp();
        $this->csvStrategy = $this->container->get(CsvLoaderStrategy::class);
    }

    public function testCsvLoaderStrategyInstanciatedCorrectly()
    {
        $this->assertInstanceOf(CsvLoaderStrategy::class, $this->csvStrategy);
    }
    public function testReturnsProductsFromCsvFile()
    {
        $products = $this->csvStrategy->getProducts();
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);
        $this->assertContainsOnlyInstancesOf(ProductInterface::class, $products);
        $this->assertObjectHasAttribute('id', $products[0]);
        $this->assertObjectHasAttribute('name', $products[0]);
        $this->assertObjectHasAttribute('baseProductUnit', $products[0]);
        $this->assertObjectHasAttribute('baseProductQuantity', $products[0]);
    }
}
