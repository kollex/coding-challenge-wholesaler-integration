<?php

declare(strict_types=1);

namespace Kollex;

use Kollex\Services\LoaderServiceInterface;

class Application
{
    public function __construct(LoaderServiceInterface $loaderService)
    {
        $this->productProvider = $loaderService;
    }


    public function run(): void
    {
        $this->productProvider->load();
    }
}
