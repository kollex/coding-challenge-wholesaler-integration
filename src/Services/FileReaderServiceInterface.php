<?php

declare(strict_types=1);

namespace Kollex\Services;

interface FileReaderServiceInterface
{
    /**
     * Read file
     *
     * @param  string $path
     * @return string
     */
    public function readFile(string $path): string;
}
