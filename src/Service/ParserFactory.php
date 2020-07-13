<?php

namespace Kollex\Service;

use Kollex\Service\Parsers\ParserInterface;

class ParserFactory
{
    public static function getParser(string $source = ''): ?ParserInterface
    {
        if (!empty($source)) {
            $className = 'Kollex\\Service\\Parsers\\' . ucwords($source) . 'Parser';
            if (class_exists($className)) {
                return new $className;
            }
        }

        return null;
    }
}
