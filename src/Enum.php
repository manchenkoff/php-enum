<?php

declare(strict_types=1);

namespace Manchenkov\Enumeration;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionClassConstant;

abstract class Enum
{
    /**
     * @var mixed Enumeration value
     */
    private $value;

    /**
     * @var string Value name
     */
    private string $name;

    /**
     * @var string Value title or description
     */
    private string $title;

    protected function __construct($value, string $name, string $title)
    {
        $this->value = $value;
        $this->name = $name;
        $this->title = $title;
    }

    public static function __callStatic(string $name, array $arguments): Enum
    {
        $reflectionClass = new ReflectionClass(static::class);

        self::validate($reflectionClass, $name);

        return static::buildObject($reflectionClass, $name);
    }

    public static function getValues(): array
    {
        $reflectionClass = new ReflectionClass(static::class);

        return $reflectionClass->getConstants();
    }

    private static function validate(ReflectionClass $reflectionClass, string $name): void
    {
        $constantNameList = array_keys($reflectionClass->getConstants());

        if (!in_array($name, $constantNameList, true)) {
            throw new InvalidArgumentException('Invalid enumeration value');
        }
    }

    protected static function buildObject(ReflectionClass $reflectionClass, string $name): Enum
    {
        $reflectionConst = $reflectionClass->getReflectionConstant($name);

        $title = self::extractTitle($reflectionConst);

        return new static(
            $reflectionConst->getValue(),
            $reflectionConst->getName(),
            $title
        );
    }

    private static function extractTitle(ReflectionClassConstant $const): ?string
    {
        $annotationTag = "@title";
        $comment = $const->getDocComment();

        if ($comment !== false) {
            $matches = [];
            $searchPattern = "/{$annotationTag}\s(.*)/";

            preg_match($searchPattern, $comment, $matches);

            if (!empty($matches)) {
                $titleComment = $matches[1];

                return preg_replace($searchPattern, "$1", $titleComment);
            }
        }

        return null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function is(Enum $enum): bool
    {
        if (!$enum instanceof $this) {
            return false;
        }

        return $this->eq($enum->getValue());
    }

    public function eq($value): bool
    {
        return $this->value === $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}