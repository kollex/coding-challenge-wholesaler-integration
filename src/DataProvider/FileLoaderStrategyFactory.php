<?php

declare(strict_types=1);

namespace Kollex\DataProvider;

use Kollex\Services\FileReaderServiceInterface;

class FileLoaderStrategyFactory
{
    /**
     * fileReader
     *
     * @var FileReaderServiceInterface
     */
    protected $fileReader;

    /**
     * __construct
     *
     * @param  FileReaderServiceInterface $fileReader
     * @return void
     */
    public function __construct(FileReaderServiceInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }
    /**
     * Factory Design pattern implementation to get Strategies
     *
     * @param  string $type
     * @return DataProviderInterface
     */
    public function getLoadingStrategy(string $type): DataProviderInterface
    {
        switch ($type) {
            case 'csv':
                return new Strategies\CsvLoaderStrategy($this->fileReader);
                break;
            case 'json':
                return new Strategies\JsonLoaderStrategy($this->fileReader);
                break;
        }
    }
}
