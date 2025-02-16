<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Enum;

enum Operator: string
{
	case EQUAL = '==';
	case IDENTICAL = '===';
	case NOT_EQUAL = '!=';
	case NOT_EQUAL_DIAMOND = '<>';
	case NOT_IDENTICAL = '!==';
	case LESS_THAN = '<';
	case GREATER_THAN = '>';
	case LESS_THAN_OR_EQUAL = '<=';
	case GREATER_THAN_OR_EQUAL = '>=';
	case SPACESHIP = '<=>';

	public function compare(mixed $left, mixed $right): bool|int
	{
		return self::{'compare_'.$this->name}($left, $right);
	}

	private static function compare_EQUAL(mixed $left, mixed $right): bool
	{
		return $left == $right;
	}

	private static function compare_IDENTICAL(mixed $left, mixed $right): bool
	{
		return $left === $right;
	}

	private static function compare_NOT_EQUAL(mixed $left, mixed $right): bool
	{
		return $left != $right;
	}

	private static function compare_NOT_EQUAL_DIAMOND(mixed $left, mixed $right): bool
	{
		return self::compare_NOT_EQUAL($left, $right);
	}

	private static function compare_NOT_IDENTICAL(mixed $left, mixed $right): bool
	{
		return $left !== $right;
	}

	private static function compare_LESS_THAN(mixed $left, mixed $right): bool
	{
		return $left < $right;
	}

	private static function compare_GREATER_THAN(mixed $left, mixed $right): bool
	{
		return $left > $right;
	}

	private static function compare_LESS_THAN_OR_EQUAL(mixed $left, mixed $right): bool
	{
		return $left <= $right;
	}

	private static function compare_GREATER_THAN_OR_EQUAL(mixed $left, mixed $right): bool
	{
		return $left >= $right;
	}

	private static function compare_SPACESHIP(mixed $left, mixed $right): int
	{
		return $left <=> $right;
	}
}
