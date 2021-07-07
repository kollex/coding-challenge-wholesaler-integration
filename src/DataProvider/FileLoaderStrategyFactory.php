<?php

declare(strict_types=1);

namespace Kollex\DataProvider;

use Kollex\Services\FileReaderServiceInterface;

class FileLoaderStrategyFactory
{
    protected $fileReader;
    public function __construct(FileReaderServiceInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }
    public function getLoadingStrategy(string $type): DataProviderInterface
    {
        switch ($type) {
            case 'csv':
                return new Strategies\JsonLoaderStrategy($this->fileReader);
                break;
            case 'json':
                return new Strategies\JsonLoaderStrategy($this->fileReader);
                break;
        }
    }
}
