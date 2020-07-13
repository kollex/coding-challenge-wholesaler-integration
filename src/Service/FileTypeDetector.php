<?php

namespace Kollex\Service;

class FileTypeDetector
{
    private static $recognizedTypes = [
        'json',
        'csv'
    ];

    public static function getType(string $filename)
    {
        $result = '';
        if (substr($filename, 0, 1) !== '.' &&
            strstr($filename, '.') !== false) {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (array_search($ext, self::$recognizedTypes) !== false) {
                $result = $ext;
            }
        }

        return $result;
    }

    public static function getName(string $filename)
    {
        $result = $filename;
        if (substr($filename, 0, 1) !== '.'  &&
            strstr($filename, '.') !== false) {
            return pathinfo($filename, PATHINFO_FILENAME);
        }

        return $result;
    }
}
