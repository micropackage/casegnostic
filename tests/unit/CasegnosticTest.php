<?php

$object = new class {
	use \Micropackage\Casegnostic\Casegnostic;

	public int $snake_case_property = 1;
	public int $camelCaseProperty = 1;

	public function snake_case_method(): int { return 1; }
	public function camelCaseMethod(): int { return 1; }
	public static function snake_case_static_method(): int { return 1; }
	public static function camelCaseStaticMethod(): int { return 1; }

	public function snake_case_method_one_arg(string $a): string { return $a; }
	public function camelCaseMethodOneArg(string $a): string { return $a; }
	public static function snake_case_static_method_one_arg(string $a): string { return $a; }
	public static function camelCaseStaticMethodOneArg(string $a): string { return $a; }

	public function snake_case_method_two_arg(string $a, string $b): string { return $a . $b; }
	public function camelCaseMethodTwoArg(string $a, string $b): string { return $a . $b; }
	public static function snake_case_static_method_two_arg(string $a, string $b): string { return $a . $b; }
	public static function camelCaseStaticMethodTwoArg(string $a, string $b): string { return $a . $b; }
};

test('unset ', function($property) {
	unset($property);
	expect(isset($property))->toBeFalsy();
})->with([
	 'snake_case property by camelCase' => $object->snakeCaseProperty,
	 'camelCase property by snake_case' => $object->camel_case_property,
]);

test('isset ', function($property, $bool) {
	expect(isset($property))->toBe($bool);
})->with([
	  'snake_case property by camelCase' => [$object->snakeCaseProperty, true],
	  'camelCase property by snake_case' => [$object->camel_case_property, true],
	  'undefined property to be false' => [$object->undefnied_property, false],
]);

test('set ', function($property, $value) use ($object) {
	$object->{$property} = $value;
	expect($object->{$property})->toBe($value);
})->with([
	 'camelCase property by snake_case' => ['camel_case_property', 5],
]);

test('get ', function($first, $second) {
	expect($first)->toBe($second);
}
)->with([
	'snake_case property as camelcase' => [$object->snakeCaseProperty, $object->snake_case_property],
	'camelCase property as snake_case' => [$object->camel_case_property, $object->camelCaseProperty],
	'snake_case method as camelCase' => [$object->snakeCaseMethod(), $object->snake_case_method()],
	'camelCase method as snake_case' => [$object->camel_case_method(), $object->camelCaseMethod()],
	'snake_case static method as camelCase' => [$object::snakeCaseStaticMethod(), $object::snake_case_static_method()],
	'camelCase static method as snake_case' => [$object::camelCaseStaticMethod(), $object::camel_case_static_method()],
	'snake_case method as camelCase, one arg' => [$object->snakeCaseMethodOneArg('test'), $object->snake_case_method_one_arg('test')],
	'camelCase method as snake_case, one arg' => [$object->camelCaseMethodOneArg('test'), $object->camel_case_method_one_arg('test')],
	'snake_case static method as camelCase, one arg' => [$object::snakeCaseStaticMethodOneArg('test'), $object::snake_case_static_method_one_arg('test')],
	'camelCase static method as snake_case, one arg' => [$object::camelCaseStaticMethodOneArg('test'), $object::camel_case_static_method_one_arg('test')],
	'snake_case method as camelCase, two arg' => [$object->snakeCaseMethodTwoArg('test', ' passed'), $object->snake_case_method_two_arg('test', ' passed')],
	'camelCase method as snake_case, two arg' => [$object->camelCaseMethodTwoArg('test', ' passed'), $object->camel_case_method_two_arg('test', ' passed')],
	'snake_case static method as camelCase, two arg' => [$object::snakeCaseStaticMethodTwoArg('test', ' passed'), $object::snake_case_static_method_two_arg('test', ' passed')],
	'camelCase static method as snake_case, two arg' => [$object::camelCaseStaticMethodTwoArg('test', ' passed'), $object::camel_case_static_method_two_arg('test', ' passed')],
]);
