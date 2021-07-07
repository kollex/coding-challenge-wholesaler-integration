<?php

declare(strict_types=1);

namespace Kollex\Services;

class FileReaderService implements FileReaderServiceInterface
{
    public function readFile(string $path)
    {
        return  file_get_contents($path);
    }
}
