<?php


namespace Kollex\Service\Ingestors;

use Kollex\Dataprovider\Assortment\AssortmentProduct;

interface IngestorInterface
{
    public function parseRowsIntoProducts(array $data): AssortmentProduct;
}
