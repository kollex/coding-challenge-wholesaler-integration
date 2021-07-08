<?php

declare(strict_types=1);

namespace Kollex;

use Kollex\Services\LoaderServiceInterface;

class Application
{
    /**
     * __construct
     *
     * @param  mixed $loaderService
     * @return void
     */
    public function __construct(LoaderServiceInterface $loaderService)
    {
        $this->productProvider = $loaderService;
    }


    /**
     * Run The app
     *
     * @return void
     */
    public function run(): void
    {
        $this->productProvider->load();
    }
}
