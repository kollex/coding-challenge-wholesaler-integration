<?php

namespace Tests;

use Kollex\Assortment\ProductInterface;
use Kollex\DataProvider\Strategies\JsonLoaderStrategy;
use PHPUnit\Framework\TestCase;

class JsonLoaderStrategyTest extends TestCase
{
    use bootstrapApp;

    protected function setUp(): void
    {
        $this->initApp();
        $this->jsonStrategy = $this->container->get(JsonLoaderStrategy::class);
    }

    public function testJsonLoaderStrategyInstanciatedCorrectly()
    {
        $this->assertInstanceOf(JsonLoaderStrategy::class, $this->jsonStrategy);
    }
    public function testReturnsProductsFromJsonFile()
    {
        $products = $this->jsonStrategy->getProducts();
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);
        $this->assertContainsOnlyInstancesOf(ProductInterface::class, $products);
        $this->assertObjectHasAttribute('id', $products[0]);
        $this->assertObjectHasAttribute('name', $products[0]);
        $this->assertObjectHasAttribute('baseProductUnit', $products[0]);
        $this->assertObjectHasAttribute('baseProductQuantity', $products[0]);
    }
}
