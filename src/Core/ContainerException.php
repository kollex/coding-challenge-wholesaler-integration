<?php

declare(strict_types=1);

namespace Kollex\Core;

use Psr\Container\ContainerExceptionInterface;
use Exception;

class ContainerException extends Exception implements ContainerExceptionInterface
{
}
