<?php

namespace Kollex\Filesystem;

use Assert\Assertion;
use DirectoryIterator;
use Kollex\DataProvider\DataProviderInterface;

class DirectoryDataProvider implements DataProviderInterface
{
    /** @var FileReaderInterface[] */
    private array $fileReaders;

    public function __construct(
        private string $path,
        FileReaderInterface  ...$fileReaders
    ) {
        Assertion::directory($this->path);
        $this->fileReaders = $fileReaders;
    }

    public function getProducts(): array
    {
        $products = [];
        $dir = new DirectoryIterator($this->path);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isFile()) {
                continue;
            }

            foreach ($this->fileReaders as $reader) {
                if ($reader->supports($fileinfo->getPathname())) {
                    $products += iterator_to_array($reader->read($fileinfo->getPathname()));
                }
            }
        }

        return $products;
    }
}