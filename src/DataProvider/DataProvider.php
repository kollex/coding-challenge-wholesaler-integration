<?php

declare(strict_types=1);

namespace Kollex\DataProvider;

use Kollex\Assortment\ProductInterface;
use stdClass;

class DataProvider implements DataProviderInterface
{
    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array
    {

        return json_decode(file_get_contents(__DIR__ . '/../../data/wholesaler_b.json'), true);
    }
}
