<?php

namespace Kollex\Filesystem;

use Kollex\Assortment\ProductInterface;

interface FileReaderInterface
{
    /**
     * @return ProductInterface[]
     */
    public function read(string $filename): iterable;

    public function supports(string $filename): bool;
}
