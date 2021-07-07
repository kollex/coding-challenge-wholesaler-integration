<?php

declare(strict_types=1);

namespace Kollex\DataProvider\Strategies;

use Kollex\DataProvider\DataProviderInterface;
use Kollex\Services\FileReaderServiceInterface;

class CsvLoaderStrategy implements DataProviderInterface
{
    public function __construct(FileReaderServiceInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }
    public function getProducts(): array
    {
        return [];
    }
}
