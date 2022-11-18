<?php

declare(strict_types=1);

/**
 * CaseHelper
 *
 * @package micropackage/casegnostic
 */

namespace Micropackage\Casegnostic\Helpers;

/**
 * Case Helper Class
 *
 * Used to help with identifying and changing cases
 */
class CaseHelper
{
    /**
     * @param string $name
     * @return false|int
     */
    public static function isSnake( string $name)
    {
        return preg_match('/^[a-zA-Z0-9]+?(_[a-zA-Z0-9]+)+$/', $name);
    }

    /**
     * @param string $name
     * @return false|int
     */
    public static function isCamel( string $name)
    {
        return preg_match('/^[a-z]+([A-Z][a-z]+)+$/', $name);
    }

    /**
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public static function toSnake( string $name)
    {
        if (self::isCamel($name)) {
            return strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1_', $name) ?? '');
        }

        throw new \InvalidArgumentException("'$name' is not in camelCase format");
    }

    /**
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public static function toCamel( string $name)
    {
        if (self::isSnake($name)) {
            return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
        }

        throw new \InvalidArgumentException("'$name' is not in snake_case format");
    }
}
