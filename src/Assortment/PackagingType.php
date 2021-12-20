<?php

namespace Kollex\Assortment;

use InvalidArgumentException;
use UnhandledMatchError;

enum PackagingType
{
    case CA;
    case BX;
    case BO;

    public static function resolve(string $type): PackagingType
    {
        $type = mb_strtolower($type);
        if (str_contains($type, ' ')) {
            $type = substr(strtolower($type), 0, strpos($type, ' '));
        }

        try {
            return match ($type) {
                'bottle' => PackagingType::BO,
                'box' => PackagingType::BX,
                'case' => PackagingType::CA
            };
        } catch (UnhandledMatchError $e) {
            throw new InvalidArgumentException(sprintf('%s packaging is ambiguous', $type), 0, $e);
        }
    }
}