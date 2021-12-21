<?php

namespace Kollex\Filesystem;

use Assert\Assertion;
use Kollex\Assortment\BaseProductPackagingType;
use Kollex\Assortment\BaseProductUnitType;
use Kollex\Assortment\PackagingType;
use Kollex\Assortment\Product;
use Kollex\Assortment\ProductInterface;

class JsonFileReader implements FileReaderInterface
{
    /**
     * @return ProductInterface[]
     */
    public function read(string $filename): iterable
    {
        $data = file_get_contents($filename);
        $json = json_decode($data, true, 4, JSON_THROW_ON_ERROR);

        Assertion::keyExists($json, 'data');

        foreach ($json['data'] as $item) {
            yield (new Product())
                ->setId($item['PRODUCT_IDENTIFIER'])
                ->setGtin($item['EAN_CODE_GTIN'])
                ->setManufacturer($item['BRAND'])
                ->setName($item['NAME'])
                ->setPackaging(PackagingType::resolve($item['PACKAGE']))
                ->setBaseProductPackaging(BaseProductPackagingType::resolve($item['VESSEL']))
                ->setBaseProductUnit(BaseProductUnitType::LT)
                ->setBaseProductAmount((float)str_replace(',', '.', $item['LITERS_PER_BOTTLE']))
                ->setBaseProductQuantity((int)$item['BOTTLE_AMOUNT']);
        }
    }

    public function supports(string $filepath): bool
    {
        return basename($filepath) === 'wholesaler_b.json';
    }
}
