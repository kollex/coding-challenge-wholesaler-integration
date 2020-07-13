<?php

namespace Kollex\Dataprovider\Assortment;

class AssortmentProduct implements Product, \JsonSerializable
{
    protected $id;
    protected $gtin;
    protected $manufacturer;
    protected $name;
    protected $packaging;
    protected $baseProductPackaging;
    protected $baseProductUnit;
    protected $baseProductAmount;
    protected $baseProductQuantity;

    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $methodName = ucwords($key);
                $this->{'set'.$methodName}($value);
            }
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'gtin' => $this->getGtin(),
            'manufacturer' => $this->getManufacturer(),
            'name' => $this->getName(),
            'packaging' => $this->getPackaging(),
            'baseProductPackaging' => $this->getBaseProductPackaging(),
            'baseProductUnit' => $this->getBaseProductUnit(),
            'baseProductAmount' => $this->getBaseProductAmount(),
            'baseProductQuantity' => $this->getBaseProductQuantity(),
        ];
    }

    /** Getters & Setters */

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AssortmentProduct
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getGtin(): string
    {
        return $this->gtin;
    }

    /**
     * @param string $gtin
     * @return AssortmentProduct
     */
    public function setGtin(string $gtin)
    {
        $this->gtin = $gtin;
        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     * @return AssortmentProduct
     */
    public function setManufacturer(string $manufacturer = '')
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AssortmentProduct
     */
    public function setName(string $name = '')
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPackaging(): string
    {
        return $this->packaging;
    }

    /**
     * @param string $packaging
     * @return AssortmentProduct
     */
    public function setPackaging(string $packaging)
    {
        $this->packaging = $packaging;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseProductPackaging(): string
    {
        return $this->baseProductPackaging;
    }

    /**
     * @param string $baseProductPackaging
     * @return AssortmentProduct
     */
    public function setBaseProductPackaging(string $baseProductPackaging)
    {
        $this->baseProductPackaging = $baseProductPackaging;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseProductUnit(): string
    {
        return $this->baseProductUnit;
    }

    /**
     * @param string $baseProductUnit
     * @return AssortmentProduct
     */
    public function setBaseProductUnit(string $baseProductUnit)
    {
        $this->baseProductUnit = $baseProductUnit;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseProductAmount(): float
    {
        return $this->baseProductAmount;
    }

    /**
     * @param float $baseProductAmount
     * @return AssortmentProduct
     */
    public function setBaseProductAmount(float $baseProductAmount)
    {
        $this->baseProductAmount = $baseProductAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseProductQuantity(): int
    {
        return $this->baseProductQuantity;
    }

    /**
     * @param int $baseProductQuantity
     * @return AssortmentProduct
     */
    public function setBaseProductQuantity(int $baseProductQuantity)
    {
        $this->baseProductQuantity = $baseProductQuantity;
        return $this;
    }
}
