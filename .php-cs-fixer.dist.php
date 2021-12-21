<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['data', 'docker-files'])
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
return $config->setRules(['@PSR12' => true])
    ->setFinder($finder);