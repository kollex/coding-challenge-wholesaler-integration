<?php

declare(strict_types=1);

namespace Kollex\DataProvider;

use Kollex\Assortment\ProductInterface;

interface DataProviderInterface
{
    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array;
}
