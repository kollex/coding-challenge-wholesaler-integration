<?php

namespace Kollex\Service\Parsers;

class CsvParser extends FileParser implements ParserInterface
{
    public function parseFile(string $fileResource): \Generator
    {
        $fp = $this->openFile($fileResource);
        while (($row = fgetcsv($fp, 0, ";")) !== false) {
            yield $row;
        }
    }
}
