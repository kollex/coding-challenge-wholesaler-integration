<?php

declare(strict_types=1);

namespace Kollex\App\Assortment;

interface ProductInterface
{
    /**
     * Process the product importing file
     *
     * @return array
     */
    public function process(): array;
}
