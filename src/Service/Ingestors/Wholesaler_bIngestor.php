<?php

namespace Kollex\Service\Ingestors;

use Kollex\Dataprovider\Assortment\AssortmentProduct;
use Kollex\Service\MeasurementDetector;
use Kollex\Service\PackagingDetector;

class Wholesaler_bIngestor implements IngestorInterface
{
    public function parseRowsIntoProducts(array $data): AssortmentProduct
    {
        if (!empty($data)) {
            $productRow = [
                "id" => $data['PRODUCT_IDENTIFIER'] ?? null,
                'gtin' => $data['EAN_CODE_GTIN'] ?? '',
                "manufacturer" => $data['BRAND'] ?? '',
                "name" => $data['NAME'] ?? '',
                "packaging" => PackagingDetector::getPackaging($data['PACKAGE']),
                "baseProductPackaging" => PackagingDetector::getPackaging($data['VESSEL']),
                "baseProductUnit" => 'LT', // This reflects just the current data
                "baseProductAmount" => (float) (str_replace(',', '.', $data['LITERS_PER_BOTTLE']) ?? 0),
                "baseProductQuantity" => (int) ($data['BOTTLE_AMOUNT'] ?? 0)
            ];

            return new AssortmentProduct($productRow);
        }
    }
}
