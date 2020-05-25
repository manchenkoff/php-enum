<?php

declare(strict_types=1);

namespace Manchenkov\Enumeration;

use ReflectionClass;
use ReflectionClassConstant;
use TypeError;

abstract class StrictEnum extends Enum
{
    protected static function buildObject(ReflectionClass $reflectionClass, string $name): Enum
    {
        self::checkTypes($reflectionClass->getReflectionConstants());

        return parent::buildObject($reflectionClass, $name);
    }

    /**
     * @param ReflectionClassConstant[] $constants
     *
     * @return bool
     */
    private static function checkTypes(array $constants): bool
    {
        $types = [];

        foreach ($constants as $constant) {
            $value = $constant->getValue();

            $types[] =
                (gettype($value) !== 'object')
                    ? gettype($value)
                    : get_class($value);
        }

        sort($types);

        [$first, $last] = [reset($types), end($types)];

        if ($first !== $last) {
            throw new TypeError('Enumeration must contain variables of the same type.');
        }

        return false;
    }
}