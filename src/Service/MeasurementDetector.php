<?php

namespace Kollex\Service;

class MeasurementDetector
{
    // this regex captures the data in two blocks. It is intentionally leaving out groups without units.
    const DETECT_REGEX = '/^(\d+.?,?\d+?)(\w)$/';

    public static function getMeasure(string $package): string
    {
        $matches = [];
        preg_match(self::DETECT_REGEX, $package, $matches);
        $unit = $matches[2] ?? '';
        $detected = '';
        switch ($unit) {
            case 'l':
                $detected = 'LT';
                break;
            case 'g':
                $detected = 'GR';
                break;
        }

        return $detected;
    }

    /**
     * Very straightforward approach
     *
     * @param string $package
     * @return float
     */
    public static function getQuantity(string $package): float
    {
        $matches = [];
        preg_match(self::DETECT_REGEX, $package, $matches);

        return (float) ($matches[1] ?? 0);
    }
}
