<?php

namespace Kollex\Assortment;

enum BaseProductPackagingType
{
    case BO;
    case CN;

    public static function resolve(string $type): BaseProductPackagingType
    {
        return match ($type) {
            'bottle' => BaseProductPackagingType::BO,
            'can'=> BaseProductPackagingType::CN
        };
    }
}