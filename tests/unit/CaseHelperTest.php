<?php

use \Micropackage\Casegnostic\Helpers\CaseHelper;

$snakeCaseValues = [
	'snake_case',
	'snake_case_case',
	'snake_case_case_case',
	'snake_Case',
	'Snake_Case',
	'snake_caseCase'
];

$camelCaseValues = [
	'camelCase',
	'camelCaseCase',
	'camelCaseCaseCase',
];

$falseValues = [
	'_whateverCase',
	'_whatever_case',
	'WhateverCase_',
];

test("isSnake returns true for snake case values", function() use ($snakeCaseValues) {
	foreach($snakeCaseValues as $value) {
		expect(CaseHelper::isSnake($value))->toBeTruthy();
	}
});

test("isSnake returns false for camel case values and false values", function() use ($camelCaseValues, $falseValues) {
	foreach(array_merge($camelCaseValues, $falseValues) as $value) {
		expect(CaseHelper::isSnake($value))->toBeFalsy();
	}
});

test("isCamel returns true for camel case values", function() use ($camelCaseValues) {
	foreach($camelCaseValues as $value) {
		expect(CaseHelper::isCamel($value))->toBeTruthy();
	}
});

test("isCamel returns false for snake case values and false values", function() use ($snakeCaseValues, $falseValues) {
	foreach(array_merge($snakeCaseValues, $falseValues) as $value) {
		expect(CaseHelper::isCamel($value))->toBeFalsy();
	}
});

test("toSnake returns all camel case values to snake case", function() use ($camelCaseValues) {
	foreach($camelCaseValues as $value) {
		expect(CaseHelper::isSnake(CaseHelper::toSnake($value)))->toBeTruthy();
	}
});

test("toCamel returns all snake case values to camel case", function() use ($snakeCaseValues) {
	foreach($snakeCaseValues as $value) {
		expect(CaseHelper::isCamel(CaseHelper::toCamel($value)))->toBeTruthy();
	}
});

test("toSnake throws exception for camel case and false values", function() use ($snakeCaseValues, $falseValues) {
	foreach(array_merge($snakeCaseValues, $falseValues) as $value) {
		CaseHelper::isSnake(CaseHelper::toSnake($value));
	}
})->throws(Exception::class);

test("toCamel throws exception for snake case and false values", function() use ($camelCaseValues, $falseValues) {
	foreach(array_merge($camelCaseValues, $falseValues) as $value) {
		CaseHelper::isCamel(CaseHelper::toCamel($value));
	}
})->throws(Exception::class);
