<?php

declare(strict_types=1);

namespace Kollex\DataProvider\Strategies;

use Kollex\DataProvider\DataProviderInterface;
use Kollex\Services\FileReaderServiceInterface;
use Kollex\Assortment\Product;

class JsonLoaderStrategy implements DataProviderInterface
{
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
     * getProducts
     *
     * @return array
     */
    public function getProducts(): array
    {
        $products = json_decode($this->fileReader->readfile(config('JSON_DATA_FILE_PATH')), true)['data'];

        array_walk($products, function (&$element) {
            $element = $this->mapProduct($element);
        });

        return $products;
    }
    /**
     * Data Mapper for product
     *
     * @param  mixed $rawProduct
     * @return Product
     */
    private function mapProduct(array $rawProduct): Product
    {
        $product = [];
        $product['id'] = $rawProduct['PRODUCT_IDENTIFIER'];
        $product['gtin'] = $rawProduct['EAN_CODE_GTIN'];
        $product['manufacturer'] = $rawProduct['BRAND'];
        $product['name'] = $rawProduct['NAME'];
        $packaging = $rawProduct['PACKAGE'];
        $product['packaging'] = config('PACKAGING')[strtolower($packaging)] ?? '';
        $product['baseProductPackaging'] = config('BASE_PACKAGING')[strtolower($rawProduct['VESSEL'])] ?? '';
        $product['baseProductUnit'] = array_key_exists('LITERS_PER_BOTTLE', $rawProduct) ? config('UNITS')['l'] : config('UNITS')['g'];
        $product['baseProductAmount'] = (float) $rawProduct['LITERS_PER_BOTTLE'];
        $product['baseProductQuantity'] = (int) $rawProduct['BOTTLE_AMOUNT'];

        return Product::create($product);
    }
}
