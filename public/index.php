<?php
require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../src/bootstrap/app.php';

$application = $container->get(Kollex\Application::class);

$application->run();
