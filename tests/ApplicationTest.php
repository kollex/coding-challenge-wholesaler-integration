<?php

namespace Tests;

use Kollex\Application;
use Kollex\Services\LoaderServiceInterface;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    use bootstrapApp;

    protected function setUp(): void
    {
        $this->app = $this->initApp();
    }

    public function testApplicationInstanciatedCorrectly()
    {
        $this->assertInstanceOf(Application::class, $this->app);
    }
    public function testApplicationHasCorrectDependencies()
    {
        $this->assertNotNull($this->app->productProvider);
        $this->assertInstanceOf(LoaderServiceInterface::class, $this->app->productProvider);
    }
}
