<?php

namespace Kollex\App\Services\ProductsImporter;

use Kollex\Assortment\ProductInterface;

class AbstractProductsImporter
{
    /**
     * @Todo: To read it from a config
     *
     * Folder with the received files
     */
    private const filesToImportPath = './data/inbound/';

    public function __construct()
    {
    }

    public function process(): array
    {

    }

    /**
     * @return array
     */
    protected function getFilesToImport() : array
    {
        return \glob(self::filesToImportPath . '*');
    }

    /**
     * @param string $filePath
     *
     * @return array
     */
    protected function getFileMetadata(string $filePath) : array
    {
        return \pathinfo($filePath);
    }
}