<?php

namespace Kollex\Dataprovider\Assortment;


use PHPUnit\Framework\TestCase;

class AssortmentProductTest extends TestCase
{

    /**
     * @dataProvider assortmentDataProvider
     * @param $data
     */
    public function testJsonSerialize(array $data)
    {
        $sut = new AssortmentProduct($data);
        $product = $sut->jsonSerialize();
        $this->assertTrue(is_array($product));
        $this->assertTrue(is_int($product['id']) && $product['id'] == $data['id'], 'Id is valid');
        $this->assertTrue(is_string($product['gtin']) && $product['gtin'] == $data['gtin'], 'Gtin is valid');
        $this->assertTrue(is_string($product['manufacturer']) && $product['manufacturer'] == $data['manufacturer'], 'Manufacturer is valid');
        $this->assertTrue(is_string($product['name']) && $product['name'] == $data['name'], 'Name is valid');
        $this->assertTrue(is_string($product['packaging']) && $product['packaging'] == $data['packaging'], 'Packaging is valid');
        $this->assertTrue(is_string($product['baseProductPackaging']) && $product['baseProductPackaging'] == $data['baseProductPackaging'], 'Base product packaging is valid');
        $this->assertTrue(is_string($product['baseProductUnit']) && $product['baseProductUnit'] == $data['baseProductUnit'], 'Base product unit is valid');
        $this->assertTrue(is_float($product['baseProductAmount']) && $product['baseProductAmount'] == $data['baseProductAmount'], 'Base product amount is valid');
        $this->assertTrue(is_int($product['baseProductQuantity']) && $product['baseProductQuantity'] == $data['baseProductQuantity'], 'Base product quantity is valid');
    }

    /**
     * Ideally you want to make this provider with a fixture that is a segment of your live data
     * @return array
     */
    public function assortmentDataProvider(): array
    {
        return [
            ['base case 0' => [
                'id' => 1,
                'gtin' => '24880602029766',
                'manufacturer' => 'Test',
                'name' => 'Test Name 0',
                'packaging' => 'Test Packaging',
                'baseProductPackaging' => 'Test Product Packaging',
                'baseProductUnit' => 'Test Product Unit',
                'baseProductAmount' => 1,
                'baseProductQuantity' => 1,
            ],],
            ['base case 1' => [
                'id' => 2,
                'gtin' => '24880602029767',
                'manufacturer' => 'Test',
                'name' => 'Test Name 1',
                'packaging' => 'Test Packaging',
                'baseProductPackaging' => 'Test Product Packaging',
                'baseProductUnit' => 'Test Product Unit',
                'baseProductAmount' => 2.3,
                'baseProductQuantity' => 2,
            ],],
        ];
    }
}
