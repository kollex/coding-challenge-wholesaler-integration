<?php

function config($param)
{
    $config = require "config.php";
    return $config["$param"] ?? null;
}
