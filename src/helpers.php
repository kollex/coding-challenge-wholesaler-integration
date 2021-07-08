<?php

/**
 * Config function helper to get config entry from config file
 *
 * @param  string $param
 * @return mixed
 */
function config($param)
{
    $config = require "config.php";
    return $config[$param] ?? null;
}
