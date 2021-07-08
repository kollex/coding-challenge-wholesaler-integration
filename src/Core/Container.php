<?php

declare(strict_types=1);

namespace Kollex\Core;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;

class Container implements ContainerInterface
{
    private $deps = [];

    /**
     * Get Dependency
     * The Interface/Class Binding convention is simple
     * The Interface should be the Class name suffixed with Interface
     *
     * @param  string $name
     * @return void
     */
    public function get(string $name)
    {
        if (!isset($this->deps[$name])) {
            $this->deps[$name] = $name;
        }
        try {
            $reflection =  new ReflectionClass($this->deps[$name]);

            if (!$reflection->isInstantiable()) {
                if (!$reflection->isInterface() || substr($reflection->getName(), -9) !== 'Interface') {
                    throw new ContainerException("{$reflection->getName()} is not instantiable !");
                }
                $reflection = new ReflectionClass(substr($reflection->getName(), 0, strlen($reflection->getName()) - 9));
            }
        } catch (ReflectionException $e) {
            throw new NotFoundException($e->getMessage());
        }
        $constructor = $reflection->getConstructor();
        return $constructor === null ?
            $reflection->newInstanceArgs() :
            $reflection->newInstanceArgs($this->resolveArgs($constructor));
    }

    public function has(string $name): bool
    {
        return isset($this->deps[$name]);
    }

    private function resolveArgs(ReflectionMethod $constructor)
    {
        $args = [];
        $params = $constructor->getParameters();
        foreach ($params as $param) {
            if (null !== $param->getType()) {
                $args[] = $this->get(
                    $param->getType()->getName()
                );
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            }
        }
        return $args;
    }
}
