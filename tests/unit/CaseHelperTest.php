<?php

use \Micropackage\Casegnostic\Helpers\CaseHelper;

dataset('snakeCaseValues', [
	'snake_case',
	'snake_case_case',
	'snake_case_case_case',
	'snake_Case',
	'Snake_Case',
	'snake_caseCase'
]);

dataset('camelCaseValues', [
	'camelCase',
	'camelCaseCase',
	'camelCaseCaseCase',
]);

dataset('falseValues', [
	'_whateverCase',
	'_whatever_case',
	'WhateverCase_',
	'PascalCase',
]);

test('isSnake returns true', function($snake_case_value) {
	expect(CaseHelper::isSnake($snake_case_value))->toBeTruthy();
})->with('snakeCaseValues');

test('isSnake returns false for camel case values', function($camelCaseValue) {
	expect(CaseHelper::isSnake($camelCaseValue))->toBeFalsy();
})->with('camelCaseValues');

test('isSnake returns false for falsy values', function($falsy_value) {
	expect(CaseHelper::isSnake($falsy_value))->toBeFalsy();
})->with('falseValues');

test("isCamel returns true for camelCase values", function($camelCaseValue) {
	expect(CaseHelper::isCamel($camelCaseValue))->toBeTruthy();
})->with('camelCaseValues');

test('isCamel returns false for snake_case values', function($snake_case_value) {
	expect(CaseHelper::isCamel($snake_case_value))->toBeFalsy();
})->with('snakeCaseValues');

test('isCamel returns false for falsy values', function($falsy_value) {
	expect(CaseHelper::isCamel($falsy_value))->toBeFalsy();
})->with('falseValues');

test('toSnake returns all camel case values to snake case', function($camelCaseValue) {
	expect(CaseHelper::isSnake(CaseHelper::toSnake($camelCaseValue)))->toBeTruthy();
})->with('camelCaseValues');

test("toCamel returns all snake case values to camel case", function($snakeCaseValue) {
	expect(CaseHelper::isCamel(CaseHelper::toCamel($snakeCaseValue)))->toBeTruthy();
})->with('snakeCaseValues');

test("toSnake throws exception for snake_case value", function($snakeCaseValue) {
		CaseHelper::isSnake(CaseHelper::toSnake($snakeCaseValue));
})->throws(InvalidArgumentException::class)
	->with('snakeCaseValues');

test("toSnake throws exception for false value", function($falseValue) {
	CaseHelper::isSnake(CaseHelper::toSnake($falseValue));
})->throws(InvalidArgumentException::class)
	->with('falseValues');

test("toCamel throws exception for snake_case value", function($camelCaseValue) {
	CaseHelper::isCamel(CaseHelper::toCamel($camelCaseValue));
})->throws(InvalidArgumentException::class)
	->with('camelCaseValues');

test("toCamel throws exception for false value", function($falseValue) {
	CaseHelper::isCamel(CaseHelper::toCamel($falseValue));
})->throws(InvalidArgumentException::class)
	->with('falseValues');
