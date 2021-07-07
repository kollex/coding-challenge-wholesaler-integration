<?php

declare(strict_types=1);

namespace Kollex\DataProvider\Strategies;

use Kollex\DataProvider\DataProviderInterface;
use Kollex\Services\FileReaderServiceInterface;

class JsonLoaderStrategy implements DataProviderInterface
{
    public function __construct(FileReaderServiceInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }
    public function getProducts(): array
    {
        $products = $this->fileReader->readfile(config("JSON_DATA_FILE_PATH"));
        return json_decode($products, true);
    }
}
