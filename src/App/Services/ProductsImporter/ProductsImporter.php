<?php

namespace Kollex\App\Services\ProductsImporter;

use Kollex\App\Services\FileMetadata;
use Kollex\App\Assortment\ProductInterface;

class ProductsImporter extends AbstractProductsImporter implements ProductInterface
{
    private const FILE_EXTENSION = 'extension';

    public function __construct(
        private FileMetadata $fileMetadata
    )
    {
    }

    /**
     * It process the available files in the inbound dir.
     *
     * @throws \FileHandlerNotFoundException (Custom Exception)
     * @throws \Exception
     *
     * @return array
     */
    public function process(): array
    {
        $productsCollection = [];

        try {
            foreach ($this->getFilesToImport() as $fileToImport)
                $productsCollection = $this->handle($fileToImport);
        } catch (\Exception $e) {

        }

        return $productsCollection;
    }

    /**
     * @param string $fileToImport
     *
     * @return array
     */
    private function handle(string $fileToImport): array
    {
        $fileMetadata    = $this->fileMetadata->getFileMetadata($fileToImport);
        $fileHandlerType = $fileMetadata['fileHandlerType'];

        $collection[] = $this->getProductsFrom($fileHandlerType, $fileToImport);

        return $collection;
    }

    /**
     * It normalises in uppercase the file extension, so it can be assigned programmatically a file handler for it
     *
     * @param string $fileExtension
     *
     * @return string
     */
    private function getNormalisedFileExtension(string $fileExtension) : string
    {
        return \strtoupper($fileExtension);
    }

    /**
     * @param string $fileHandlerType CSV, JSON, YAML, XML, ... Handler
     * @param string $fileToImport    The file to read products from
     *
     * @return array
     */
    private function getProductsFrom(string $fileHandlerType, string $fileToImport): array
    {
        $collection = [];

        /**
         * To use Symfony's factory creation
         * @see: https://symfony.com/doc/current/service_container/factories.html
         */
        try {
            //$fileHandlerFactory = $this->fileHandlerFactory($fileHandlerType);
            //$fileHandler        = $this->fileHandlerFactory->create();

            //$collection[] = $fileHandler->getProducts($fileToImport);

            /*} catch (\FileHandlerNotFoundException $e) {*/

        } catch (\Exception $e) {

        }

        return $collection;
    }
}