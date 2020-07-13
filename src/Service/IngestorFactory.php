<?php

namespace Kollex\Service;

use Kollex\Service\Ingestors\IngestorInterface;

class IngestorFactory
{
    public static function getIngestor(string $source = ''): ?IngestorInterface
    {
        if (!empty($source)) {
            $className = 'Kollex\\Service\\Ingestors\\' . ucwords($source) . 'Ingestor';
            if (class_exists($className)) {
                return new $className;
            }
        }

        return null;
    }
}
