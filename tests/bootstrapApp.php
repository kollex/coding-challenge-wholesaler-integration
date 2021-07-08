<?php

namespace Tests;

use Kollex\Application;

trait bootstrapApp
{

    public function initApp()
    {
        $this->container = require __DIR__ . '/../src/bootstrap/app.php';

        $app = $this->container->get(Application::class);

        return $app;
    }
}
