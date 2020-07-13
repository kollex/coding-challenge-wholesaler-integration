<?php

namespace Kollex\Service;

class PackagingDetector
{
    /**
     * Very straightforward approach
     *
     * @param string $package
     * @param string $fallbackUnit
     * @return string
     */
    public static function getPackaging(string $package, string $fallbackUnit = ''): string
    {
        if (strtolower($package) === 'single') {
            $package = $fallbackUnit;
        }
        $components = explode(' ', $package);
        $packaging = $components[0];
        $detected = 'Unknown';
        switch (strtolower($packaging)) {
            case 'case':
                $detected = 'CA';
                break;
            case 'box':
                $detected = 'BX';
                break;
            case 'bottle':
                $detected = 'BO';
                break;
            case 'can':
                $detected = 'CN';
                break;
        }

        return $detected;
    }

    /**
     * Very straightforward approach
     *
     * @param string $package
     * @return int
     */
    public static function getPackageUnits(string $package): int
    {
        if (strtolower($package) === 'single') {
            return 1;
        }
        $components = explode(' ', $package);

        return (int) ($components[1] ?? 0);
    }
}
