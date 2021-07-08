<?php

declare(strict_types=1);

namespace Kollex\Services;

abstract class AbstractLoaderService implements LoaderServiceInterface
{
    /**
     * init
     *
     * @return void
     */
    abstract public function init();
    /**
     * run
     *
     * @return void
     */
    abstract public function run();
    /**
     * finish
     *
     * @return void
     */
    abstract public function finish();




    /**
     * Template Method to run steps each by each
     *
     * @return void
     */
    public function load(): void
    {
        $this->init();
        $this->run();
        $this->finish();
    }
}
