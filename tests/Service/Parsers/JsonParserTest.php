<?php

namespace Kollex\Service\Parsers;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{
    public $root; // mock filesystem

    public function setUp(): void
    {
        $structure = [
            'csv' => [
                'input.json' => "{
  \"data\": [
    {
      \"PRODUCT_IDENTIFIER\": \"12345600001\",
      \"EAN_CODE_GTIN\": \"24880602029766\",
      \"BRAND\": \"Drinks Corp.\",
      \"NAME\": \"Soda Drink, 12x 1L\",
      \"PACKAGE\": \"case\",
      \"ADDITIONAL_INFO\": \"\",
      \"VESSEL\": \"bottle\",
      \"LITERS_PER_BOTTLE\": \"1\",
      \"BOTTLE_AMOUNT\": \"12\"
    },
    {
      \"PRODUCT_IDENTIFIER\": \"12345600002\",
      \"EAN_CODE_GTIN\": \"24880602029773\",
      \"BRAND\": \"Drinks Corp.\",
      \"NAME\": \"Orange Drink, 20x 0.5L\",
      \"PACKAGE\": \"case\",
      \"ADDITIONAL_INFO\": \"\",
      \"VESSEL\": \"bottle\",
      \"LITERS_PER_BOTTLE\": \"0,5\",
      \"BOTTLE_AMOUNT\": \"20\"
    },
    {
      \"PRODUCT_IDENTIFIER\": \"12345600003\",
      \"EAN_CODE_GTIN\": \"24880602029780\",
      \"BRAND\": \"Drinks Corp.\",
      \"NAME\": \"Beer, 6x 0.5L\",
      \"PACKAGE\": \"box\",
      \"ADDITIONAL_INFO\": \"\",
      \"VESSEL\": \"can\",
      \"LITERS_PER_BOTTLE\": \"0,5\",
      \"BOTTLE_AMOUNT\": \"6\"
    },
    {
      \"PRODUCT_IDENTIFIER\": \"12345600004\",
      \"EAN_CODE_GTIN\": \"24880602029797\",
      \"BRAND\": \"Drinks Corp.\",
      \"NAME\": \"Champagne\",
      \"PACKAGE\": \"BOTTLE\",
      \"ADDITIONAL_INFO\": \"\",
      \"VESSEL\": \"bottle\",
      \"LITERS_PER_BOTTLE\": \"0,75\",
      \"BOTTLE_AMOUNT\": \"1\"
    }
  ]
}
"
            ]
        ];

        $this->root = vfsStream::setup('root',null, $structure);
    }

    public function testParseFile()
    {
        $sut = new JsonParser();
        $result = $sut->parseFile($this->root->url() . '/csv/input.json');

        $this->assertTrue($result instanceof \Generator);
    }
}
