<?php

declare(strict_types=1);

namespace Kollex\Services;

class FileReaderService implements FileReaderServiceInterface
{
    /**
     * readFile
     *
     * @param  string $path
     * @return string
     */
    public function readFile(string $path): string
    {
        return  file_get_contents($path);
    }
}
