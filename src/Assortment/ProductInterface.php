<?php

declare(strict_types=1);

namespace Kollex\Assortment;

interface ProductInterface
{
    public function getId(): ?string;

    public function getGtin(): ?string;

    public function getManufacturer(): ?string;

    public function getName(): ?string;

    public function getPackaging(): ?PackagingType;

    public function getBaseProductPackaging(): ?BaseProductPackagingType;

    public function getBaseProductUnit(): ?BaseProductUnitType;

    public function getBaseProductAmount(): ?float;

    public function getBaseProductQuantity(): ?int;
}