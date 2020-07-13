<?php

namespace Kollex\Service\Parsers;

interface ParserInterface
{
    public function parseFile(string $fileResource): \Generator;
}
