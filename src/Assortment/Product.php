<?php

declare(strict_types=1);

namespace Kollex\Assortment;

use JsonSerializable;

class Product implements ProductInterface, JsonSerializable
{
    /**
     * id
     *
     * @var string
     */
    private $id;
    /**
     * gtin
     *
     * @var string
     */
    private $gtin;
    /**
     * manufacturer
     *
     * @var string
     */
    private $manufacturer;
    /**
     * name
     *
     * @var string
     */
    private $name;
    /**
     * packaging
     *
     * @var string
     */
    private $packaging;
    /**
     * baseProductPackaging
     *
     * @var string
     */
    private $baseProductPackaging;
    /**
     * baseProductUnit
     *
     * @var string
     */
    private $baseProductUnit;
    /**
     * baseProductAmount
     *
     * @var float
     */
    private $baseProductAmount;
    /**
     * baseProductQuantity
     *
     * @var int
     */
    private $baseProductQuantity;


    /**
     * __construct
     *
     * @param  string $id
     * @param  string $gtin
     * @param  string $manufacturer
     * @param  string $name
     * @param  string $packaging
     * @param  string $baseProductPackaging
     * @param  string $baseProductUnit
     * @param  float $baseProductAmount
     * @param  int $baseProductQuantity
     * @return void
     */
    public function __construct(
        string $id,
        string $gtin,
        string $manufacturer,
        string $name,
        string $packaging,
        string $baseProductPackaging,
        string $baseProductUnit,
        float $baseProductAmount,
        int $baseProductQuantity
    ) {
        $this->id = $id;
        $this->gtin = $gtin;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->packaging = $packaging;
        $this->baseProductPackaging = $baseProductPackaging;
        $this->baseProductUnit = $baseProductUnit;
        $this->baseProductAmount = $baseProductAmount;
        $this->baseProductQuantity = $baseProductQuantity;
    }

    /**
     * create
     *
     * @param  array $data
     * @return ProductInterface
     */
    public static function create(array $data): ProductInterface
    {
        $id = $data['id'];
        $gtin = $data['gtin'];
        $manufacturer = $data['manufacturer'];
        $name = $data['name'];
        $packaging = $data['packaging'];
        $baseProductPackaging = $data['baseProductPackaging'];
        $baseProductUnit = $data['baseProductUnit'];
        $baseProductAmount = $data['baseProductAmount'];
        $baseProductQuantity = $data['baseProductQuantity'];

        return new static(
            $id,
            $gtin,
            $manufacturer,
            $name,
            $packaging,
            $baseProductPackaging,
            $baseProductUnit,
            $baseProductAmount,
            $baseProductQuantity,
        );
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'gtin' => $this->gtin,
            'manufacturer' => $this->manufacturer,
            'name' => $this->name,
            'packaging' => $this->packaging,
            'baseProductPackaging' => $this->baseProductPackaging,
            'baseProductUnit' => $this->baseProductUnit,
            'baseProductAmount' => $this->baseProductAmount,
            'baseProductQuantity' => $this->baseProductQuantity
        ];
    }
}
