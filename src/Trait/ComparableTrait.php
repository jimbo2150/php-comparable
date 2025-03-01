<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpUtilities\Traits;

/**
 * Trait to provide comparison methods to objects it is a trait of.
 *
 * This is required to be assigned as a trait to any objects you wish to
 * perform comparisons on.
 *
 * Also provides convenience method to define custom comparison functions that
 * require more expressions/computation than the simple operator comparisons
 * provide.
 */
trait ComparableTrait
{
	/**
	 * This is the primary function that performs standard comparison between
	 * two values: the value provided by the current object and another value
	 * which can be provided by another comparable object's value, scalar value,
	 * or array of values.
	 *
	 * The return value with be boolean or integer based on the operator used.
	 * All will return true except for the spaceship (<=>) operator. See the
	 * PHP operator documentation for details:
	 * https://www.php.net/manual/en/language.operators.comparison.php
	 *
	 * @throws \InvalidArgumentException
	 */
	public function compareTo(
		object|array|string|int|float|bool|null $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
		$compareFunction = fn (
			mixed $thisValue,
			mixed $compareValue,
			Operator $operator,
		) => $operator->compare($thisValue, $compareValue);

		return $this->customCompareTo($compareFunction, $comparable, $operator);
	}

	/**
	 * Allows for comparing custom values using a callback that is provided
	 * the current object's compare value, the other/compare-to object's
	 * compare value, and an operator.
	 *
	 * @param callable(mixed,mixed,Operator):bool|int $callback
	 *
	 * @throws \InvalidArgumentException
	 */
	protected function customCompareTo(
		callable $callback,
		object|array|string|int|float|bool|null $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
		static $getOtherComparableValue = function (object $comparable): mixed {
			self::exceptionOnNonComparableTrait($comparable);
			/** @var ComparableTrait $comparable */

			return (new \ReflectionClass($comparable))->
				getMethod('getComparableValue')->
				invoke($comparable);
		};
		$compareValue = $comparable;
		if (is_object($comparable)) {
			$compareValue = $getOtherComparableValue($comparable);
			/** @var ComparableTrait $comparable */
		}

		return $callback($this->getComparableValue(), $compareValue, $operator);
	}

	/**
	 * This function is required to be implemented by classes this trait is
	 * assigned to in order to get the value that will be compared when
	 * compareTo() is called or another comparable object's compareTo() is
	 * passed the object as it's comparison value parameter.
	 */
	abstract protected function getComparableValue(): mixed;

	/**
	 * Convenience method to check if a given object is assigned this trait.
	 */
	final public static function hasComparableTrait(object $object): bool
	{
		return Traits::instanceOf($object, ComparableTrait::class);
	}

	/**
	 * Convenience method that throws an InvalidArgumentException when the
	 * provided object parameter is not assigned this trait.
	 *
	 * @throws \InvalidArgumentException
	 */
	final public static function exceptionOnNonComparableTrait(object $object): void
	{
		if (!self::hasComparableTrait($object)) {
			$message = 'Argument $object must have trait '.self::class;
			throw new \InvalidArgumentException($message);
		}
	}
}
