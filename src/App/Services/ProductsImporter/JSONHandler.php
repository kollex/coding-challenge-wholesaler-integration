<?php

namespace Kollex\App\Services\ProductsImporter;

use \Kollex\App\DataProvider\DataProviderInterface;

class JSONHandler implements DataProviderInterface
{
    public function __construct()
    {
    }

    /**
     * It reads the given file according to the file extension handler and it returns the results as array
     */
    public function getProducts(): array
    {
    }

}