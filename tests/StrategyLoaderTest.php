<?php

namespace Tests;

use Kollex\DataProvider\FileLoaderStrategyFactory;
use Kollex\DataProvider\Strategies\CsvLoaderStrategy, Kollex\DataProvider\Strategies\JsonLoaderStrategy;
use PHPUnit\Framework\TestCase;

class StrategyLoaderTest extends TestCase
{
    use bootstrapApp;
    protected $strategyFactory;

    protected function setUp(): void
    {
        $this->initApp();
        $this->strategyFactory = $this->container->get(FileLoaderStrategyFactory::class);
    }

    public function testStrategyLoaderInstanciatedCorrectly()
    {
        $this->assertInstanceOf(FileLoaderStrategyFactory::class, $this->strategyFactory);
    }
    public function testReturnsCsvStrategy()
    {
        $this->assertInstanceOf(CsvLoaderStrategy::class, $this->strategyFactory->getLoadingStrategy('csv'));
    }
    public function testCsvStrategyHasNotFileLoaderInstance()
    {
        $this->assertObjectNotHasAttribute("fileReader", $this->strategyFactory->getLoadingStrategy('csv'));
    }

    public function testReturnsJsonStrategy()
    {
        $this->assertInstanceOf(JsonLoaderStrategy::class, $this->strategyFactory->getLoadingStrategy('json'));
    }
    public function testStrategyHasFileLoaderInstance()
    {
        $this->assertObjectHasAttribute("fileReader", $this->strategyFactory->getLoadingStrategy('json'));
    }
}
