<?php

namespace Kollex\Filesystem;

use Assert\Assertion;
use Kollex\Assortment\BaseProductPackagingType;
use Kollex\Assortment\BaseProductUnitType;
use Kollex\Assortment\PackagingType;
use Kollex\Assortment\Product;
use Kollex\Assortment\ProductInterface;

class CsvFileReader implements FileReaderInterface
{
    public function __construct(
        private string $delimiter = ';',
        private int $maxLineLength = 1000
    )
    {
    }

    /**
     * @return ProductInterface[]
     */
    public function read(string $filename): iterable
    {
        $fp = fopen($filename, 'r');

        if (false === $fp) {
            throw new \RuntimeException('Error opening csv file');
        }

        fgets($fp); // skip first line

        while (($data = fgetcsv($fp, $this->maxLineLength, $this->delimiter)) !== false) {
            yield (new Product())
                ->setId($data[0])
                ->setGtin($data[1])
                ->setManufacturer($data[2])
                ->setName($data[3])
                ->setPackaging(PackagingType::resolve($data[5]))
                ->setBaseProductPackaging(BaseProductPackagingType::resolve($data[7]))
                ->setBaseProductUnit(BaseProductUnitType::resolve($data[8]))
                ->setBaseProductAmount(BaseProductUnitType::amount($data[8]))
                ->setBaseProductQuantity((int)$data[9]);
        }
        fclose($fp);
    }

    public function supports(string $filepath): bool
    {
        return basename($filepath) === 'wholesaler_a.csv';
    }
}