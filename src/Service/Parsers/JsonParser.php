<?php

namespace Kollex\Service\Parsers;

class JsonParser extends FileParser implements ParserInterface
{
    public function parseFile(string $fileResource): \Generator
    {
        $content = file_get_contents($fileResource);
        $content = json_decode($content, true);
        if (!empty($content)) {
            foreach ($content['data'] as $item) {
                yield $item;
            }
        }
    }
}
