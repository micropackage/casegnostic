<?php

declare(strict_types=1);

/**
 * Casegnostic
 *
 * @package micropackage/casegnostic
 */

namespace Micropackage\Casegnostic;

use Micropackage\Casegnostic\Helpers\CaseHelper;

/**
 * Casegnostic trait
 */
trait Casegnostic
{
    /**
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function __get( string $name)
    {
        if (CaseHelper::isSnake($name)) {
            if (property_exists($this, CaseHelper::toCamel($name))) {
                return $this->{CaseHelper::toCamel($name)};
            }
        }

        if (CaseHelper::isCamel($name)) {
            if (property_exists($this, CaseHelper::toSnake($name))) {
                return $this->{CaseHelper::toSnake($name)};
            }
        }

        throw new \Exception('property does not exist');
    }

    /**
     * @param string $name
     * @param array<mixed> $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call( string $name, array $arguments)
    {
        if (CaseHelper::isSnake($name)) {
            if (method_exists($this, CaseHelper::toCamel($name))) {
                return $this->{CaseHelper::toCamel($name)}(...$arguments);
            }
        }

        if (CaseHelper::isCamel($name)) {
            if (method_exists($this, CaseHelper::toSnake($name))) {
                return $this->{CaseHelper::toSnake($name)}(...$arguments);
            }
        }

        throw new \http\Exception\BadMethodCallException('method does not exist');
    }

    /**
     * @param string $name
     * @param array<mixed> $arguments
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic( string $name, array $arguments)
    {
        if (CaseHelper::isSnake($name)) {
            if (method_exists(self::class, CaseHelper::toCamel($name))) {
                return self::{CaseHelper::toCamel($name)}(...$arguments);
            }
        }

        if (CaseHelper::isCamel($name)) {
            if (method_exists(self::class, CaseHelper::toSnake($name))) {
                return self::{CaseHelper::toSnake($name)}(...$arguments);
            }
        }

        throw new \http\Exception\BadMethodCallException('static method does not exist');
    }
}
