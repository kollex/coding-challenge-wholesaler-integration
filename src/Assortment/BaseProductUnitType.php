<?php

namespace Kollex\Assortment;

enum BaseProductUnitType
{
    case LT;
    case GR;

    public static function resolve(string $type): BaseProductUnitType
    {
        return match (preg_replace('/[0-9.,]+/', '', $type)) {
            'l' => BaseProductUnitType::LT,
            'g' => BaseProductUnitType::GR
        };
    }

    public static function amount(string $type): float
    {
        $num = preg_replace('/[^0-9.,]/', '', $type);
        return (float)preg_replace('/[,]+/', '.', $num);
    }
}
