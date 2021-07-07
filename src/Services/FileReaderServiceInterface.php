<?php

declare(strict_types=1);

namespace Kollex\Services;

interface FileReaderServiceInterface
{
    public function readFile(string $path);
}
