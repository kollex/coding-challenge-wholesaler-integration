<?php

declare(strict_types=1);

namespace Kollex\DataProvider\Strategies;

use Kollex\DataProvider\DataProviderInterface;
use Kollex\Assortment\Product;

class CsvLoaderStrategy implements DataProviderInterface
{
    /**
     * getProducts
     * Read file as stream instead of loading the whole file in memory
     *
     * @return array
     */
    public function getProducts(): array
    {
        $products = [];
        $handle = fopen(config('CSV_DATA_FILE_PATH'), 'r');

        $heading = [];

        while (($row = fgets($handle)) !== false) {
            if (!count($heading)) {
                $heading = str_getcsv($row, config('CSV_DELIMITER'));
                continue;
            }
            $rawProduct = array_combine($heading, str_getcsv($row, config('CSV_DELIMITER')));
            $products[] = $this->mapProduct($rawProduct);
        }

        fclose($handle);
        return $products;
    }

    /**
     * A Data Mapper that maps raw product data to standardized format
     * as Product Model
     *
     * @param  array $rawProduct
     * @return Product
     */
    private function mapProduct(array $rawProduct): Product
    {
        $product = [];
        $product['id'] = $rawProduct['id'];
        $product['gtin'] = $rawProduct['ean'];
        $product['manufacturer'] = $rawProduct['manufacturer'];
        $product['name'] = $rawProduct['product'];
        $packaging = explode(' ', $rawProduct['packaging product']);
        $product['packaging'] = config('PACKAGING')[strtolower(reset($packaging))] ?? '';
        $product['baseProductPackaging'] = config('BASE_PACKAGING')[strtolower($rawProduct['packaging unit'])] ?? '';
        $product['baseProductUnit'] = config('UNITS')[strtolower(substr($rawProduct['amount per unit'], -1))] ?? '';
        $product['baseProductAmount'] = (float) substr($rawProduct['amount per unit'], 0, strlen($rawProduct['amount per unit']) - 1);
        $product['baseProductQuantity'] = (int) array_pop($packaging) ? (int) array_pop($packaging) : 1;

        return Product::create($product);
    }
}
