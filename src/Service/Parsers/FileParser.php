<?php

namespace Kollex\Service\Parsers;

abstract class FileParser
{
    public function openFile(string $file)
    {
        return fopen($file, 'r');
    }
}
