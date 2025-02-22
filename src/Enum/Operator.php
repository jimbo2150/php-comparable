<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Enum;

/**
 * This enumeration (enum) provides the various operator types PHP supports as
 * objects used by ComparableTrait assigned objects to perform various
 * different types of comparisons.
 */
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

	/**
	 * Calls the enumeration object's specific compare function dynamically.
	 */
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
		return self::NOT_EQUAL->compare($left, $right);
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
