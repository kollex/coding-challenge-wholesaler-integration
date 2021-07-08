<?php

declare(strict_types=1);

namespace Kollex\Assortment;

interface ProductInterface
{
    /**
     * create new Product Instance Statically
     *
     * @param  array $data
     * @return void
     */
    public static function create(array $data);
}
