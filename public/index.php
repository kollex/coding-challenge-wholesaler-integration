<?php

use Kollex\Filesystem\CsvFileReader;
use Kollex\Filesystem\DirectoryDataProvider;
use Kollex\Filesystem\JsonFileReader;

require __DIR__ . '/../vendor/autoload.php';

$dataProvider = new DirectoryDataProvider(
    __DIR__ . '/../data/',
    new CsvFileReader(),
    new JsonFileReader()
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($dataProvider->getProducts());