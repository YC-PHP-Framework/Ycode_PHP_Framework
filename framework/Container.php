<?php

namespace Yc\framework;

use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use Yc\framework\ContainerWriter;
use Psr\Container\ContainerInterface;
use Yc\App\Exceptions\ContainerException;

class Container extends ContainerWriter implements ContainerInterface
{



    public function get(string $id)
    {
        // dd($id);
        if ($this->has($id)) {
            $entry =  $this->entries[$id];
            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $resolver)
    {
        $this->entries[$id] = $resolver;
    }
    // Autowiring using Reflection Api
    public function resolve(string $id)
    {
        dd($id);
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {

            throw new ContainerException("Class {$id} is not instantiable");
        }

        // 2. Inspect the constructor of the class and its parameters (dependencies)
        $constructor = $reflectionClass->getConstructor();
        $parameters = $constructor?->getParameters();


        if (!$constructor || !$parameters) {
            return $reflectionClass->newInstance();
            // return new $id;
        }

        // 3. If the constructor parameters is a class then try to resolve that class using the container
        $dependencies = array_map(function (ReflectionParameter $params) use ($id) {
            $name = $params->getName();
            $type = $params->getType();

            // Check Type Hinting 
            if (!$type) {
                dd("type");
                throw new ContainerException(
                    "Failed to resolve class {$id} because parameter {$name} is missing a type hint ."
                );
            }

            // Check Union Type
            if ($type instanceof ReflectionUnionType) {
                dd("type of");
                throw new ContainerException(
                    "Failed to resolve class {$id} because of union type of parameter {$name} ."
                );
            }

            // Check Class Type That is not built in 
            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                // dd($type->getName());
                return $this->get($type->getName());
            }

            throw new ContainerException(
                "Failed to resolve class {$id} because of invalid parameter {$name} ."
            );
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
