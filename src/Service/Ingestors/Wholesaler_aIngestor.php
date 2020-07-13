<?php

namespace Kollex\Service\Ingestors;

use Kollex\Dataprovider\Assortment\AssortmentProduct;
use Kollex\Service\MeasurementDetector;
use Kollex\Service\PackagingDetector;

class Wholesaler_aIngestor implements IngestorInterface
{
    public function parseRowsIntoProducts(array $data): AssortmentProduct
    {
        if (!empty($data)) {
            $productRow = [
                "id" => $data[0] ?? null,
                'gtin' => $data[1] ?? '',
                "manufacturer" => $data[2] ?? '',
                "name" => $data[3] ?? '',
                "packaging" => PackagingDetector::getPackaging($data[5], $data[7]),
                "baseProductPackaging" => PackagingDetector::getPackaging($data[7]),
                "baseProductUnit" => MeasurementDetector::getMeasure($data[8]),
                "baseProductAmount" => MeasurementDetector::getQuantity($data[8]),
                "baseProductQuantity" => PackagingDetector::getPackageUnits($data[5])
            ];

            return new AssortmentProduct($productRow);
        }
    }
}
