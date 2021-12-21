<?php

namespace Kollex\Assortment;

use Assert\Assertion;
use JsonSerializable;

class Product implements ProductInterface, JsonSerializable
{
    private ?string $id = null;
    private ?string $gtin = null;
    private ?string $manufacturer = null;
    private ?string $name = null;
    private ?PackagingType $packaging = null;
    private ?BaseProductPackagingType $baseProductPackaging = null;
    private ?BaseProductUnitType $baseProductUnit = null;
    private ?float $baseProductAmount = null;
    private ?int $baseProductQuantity = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Product
    {
        Assertion::notEmpty($id, 'Id is required');
        $this->id = $id;

        return $this;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }

    public function setGtin(?string $gtin): Product
    {
        $this->gtin = $gtin;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): Product
    {
        Assertion::notEmpty($manufacturer, 'Manufacturer is required');
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Product
    {
        Assertion::notEmpty($name, 'Name is required');
        $this->name = $name;

        return $this;
    }

    public function getPackaging(): ?PackagingType
    {
        return $this->packaging;
    }

    public function setPackaging(?PackagingType $packaging): Product
    {
        Assertion::notEmpty($packaging, 'Packaging is required');
        $this->packaging = $packaging;

        return $this;
    }

    public function getBaseProductPackaging(): ?BaseProductPackagingType
    {
        return $this->baseProductPackaging;
    }

    public function setBaseProductPackaging(?BaseProductPackagingType $baseProductPackaging): Product
    {
        Assertion::notNull($baseProductPackaging, 'BaseProductPackaging is required');
        $this->baseProductPackaging = $baseProductPackaging;

        return $this;
    }

    public function getBaseProductUnit(): ?BaseProductUnitType
    {
        return $this->baseProductUnit;
    }

    public function setBaseProductUnit(?BaseProductUnitType $baseProductUnit): Product
    {
        Assertion::notNull($baseProductUnit, 'BaseProductUnit is required');
        $this->baseProductUnit = $baseProductUnit;

        return $this;
    }

    public function getBaseProductAmount(): ?float
    {
        return $this->baseProductAmount;
    }

    public function setBaseProductAmount(?float $baseProductAmount): Product
    {
        Assertion::notEmpty($baseProductAmount, 'Base product amount is required');
        $this->baseProductAmount = $baseProductAmount;

        return $this;
    }

    public function getBaseProductQuantity(): ?int
    {
        return $this->baseProductQuantity;
    }

    public function setBaseProductQuantity(?int $baseProductQuantity): Product
    {
        Assertion::notEmpty($baseProductQuantity, 'Base product qantity is required');
        $this->baseProductQuantity = $baseProductQuantity;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'gtin' => $this->getGtin(),
            'manufacturer' => $this->getManufacturer(),
            'name' => $this->getName(),
            'packaging' => $this->getPackaging()->name,
            'baseProductPackaging' => $this->getBaseProductPackaging()->name,
            'baseProductUnit' => $this->getBaseProductUnit()->name,
            'baseProductAmount' => $this->getBaseProductAmount(),
            'baseProductQuantity' => $this->getBaseProductQuantity(),
        ];
    }
}
