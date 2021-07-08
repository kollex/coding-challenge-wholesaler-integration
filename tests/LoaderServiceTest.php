<?php

namespace Tests;

use Kollex\Assortment\Product;
use Kollex\Assortment\ProductInterface;
use Kollex\DataProvider\DataProviderInterface;
use Kollex\DataProvider\FileLoaderStrategyFactory;
use Kollex\Services\LoaderServiceInterface;
use Kollex\Services\LoaderService;
use PHPUnit\Framework\TestCase;

class LoaderServiceTest extends TestCase
{
    use bootstrapApp;

    protected function setUp(): void
    {
        $this->initApp();
        $this->loaderService = $this->container->get(LoaderServiceInterface::class);
    }

    public function testLoaderServiceInstanciatedCorrectly()
    {
        $this->assertInstanceOf(LoaderService::class, $this->loaderService);
        $this->assertObjectHasAttribute("strategyFactory", $this->loaderService);
        $this->assertNotNull($this->loaderService->strategyFactory);
        $this->assertInstanceOf(FileLoaderStrategyFactory::class, $this->loaderService->strategyFactory);
        $this->assertObjectHasAttribute("products", $this->loaderService);
        $this->assertObjectHasAttribute("loaders", $this->loaderService);
        $this->assertIsArray($this->loaderService->products);
        $this->assertIsArray($this->loaderService->loaders);
    }
    public function testLoadStrategiesAfterInit()
    {
        $this->loaderService->init();

        $this->assertCount(2, $this->loaderService->loaders);
        $this->assertContainsOnlyInstancesOf(DataProviderInterface::class, $this->loaderService->loaders);
    }
    public function testGetProductsAfterRun()
    {
        $this->loaderService->init();
        $this->loaderService->run();

        $this->assertNotEmpty($this->loaderService->products);
        $this->assertContainsOnlyInstancesOf(Product::class, $this->loaderService->products);
    }
}
