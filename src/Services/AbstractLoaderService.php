<?php

declare(strict_types=1);

namespace Kollex\Services;

abstract class AbstractLoaderService implements LoaderServiceInterface
{
    abstract public function init();
    abstract public function run();
    abstract public function finish();




    public function load(): void
    {
        $this->init();
        $this->run();
        $this->finish();
    }
}
