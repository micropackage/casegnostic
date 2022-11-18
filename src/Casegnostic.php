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
	 * @return mixed|void
	 * @throws \Exception
	 */
	public function __get(string $name)
	{
		if (CaseHelper::isSnake($name)) {
			if (property_exists($this, CaseHelper::toCamel($name))) {
				return $this->{CaseHelper::toCamel($name)};
			}
		}

		if (!CaseHelper::isCamel($name)) {
			return;
		}

		if (property_exists($this, CaseHelper::toSnake($name))) {
			return $this->{CaseHelper::toSnake($name)};
		}
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 * @throws \Exception
	 */
	public function __set(string $name, $value)
	{
		if (CaseHelper::isSnake($name)) {
			if (property_exists($this, CaseHelper::toCamel($name))) {
				$this->{CaseHelper::toCamel($name)} = $value;
			}
		}

		if (!CaseHelper::isCamel($name)) {
			return;
		}

		if (!property_exists($this, CaseHelper::toSnake($name))) {
			return;
		}

		$this->{CaseHelper::toSnake($name)} = $value;
	}

	/**
	 * @param string $name
	 * @param array<mixed> $arguments
	 * @return mixed
	 * @throws \Exception
	 */
	public function __call(string $name, array $arguments)
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

		throw new \BadMethodCallException('method does not exist');
	}

	/**
	 * @param string $name
	 * @param array<mixed> $arguments
	 * @return mixed
	 * @throws \Exception
	 */
	public static function __callStatic(string $name, array $arguments)
	{
		if (CaseHelper::isSnake($name)) {
			if (method_exists(self::class, CaseHelper::toCamel($name))) {
				return static::{CaseHelper::toCamel($name)}(...$arguments);
			}
		}

		if (CaseHelper::isCamel($name)) {
			if (method_exists(self::class, CaseHelper::toSnake($name))) {
				return static::{CaseHelper::toSnake($name)}(...$arguments);
			}
		}

		throw new \BadMethodCallException('static method does not exist');
	}

	/**
	 * @param string $name
	 * @return bool
	 * @throws \Exception
	 */
	public function __isset(string $name)
	{
		if (CaseHelper::isSnake($name)) {
			return isset($this->{CaseHelper::toCamel($name)});
		}

		if (CaseHelper::isCamel($name)) {
			return isset($this->{CaseHelper::toSnake($name)});
		}

		return false;
	}

	/**
	 * @param string $name
	 * @return void
	 * @throws \Exception
	 */
	public function __unset(string $name)
	{
		if (CaseHelper::isSnake($name)) {
			if (isset($this->{CaseHelper::toCamel($name)})) {
				unset($this->{CaseHelper::toCamel($name)});
			}
		}

		if (CaseHelper::isCamel($name)) {
			if (isset($this->{CaseHelper::toSnake($name)})) {
				unset($this->{CaseHelper::toSnake($name)});
			}
		}

		throw new \InvalidArgumentException("Can't find value to unset");
	}
}
