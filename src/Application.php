<?php

declare(strict_types=1);

namespace Kollex;

use Kollex\DataProvider\DataProviderInterface;

class Application
{
    public function __construct(DataProviderInterface $productProvider)
    {
        $this->productProvider = $productProvider;
    }


    public function run(): void
    {
        print(json_encode($this->productProvider->getProducts(), JSON_PRETTY_PRINT));
    }
}
