<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;

trait ComparableTrait
{
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
	 * Summary of customCompareTo.
	 *
	 * @param callable(mixed,mixed,Operator):bool|int $callback
	 */
	private function customCompareTo(
		callable $callback,
		object|array|string|int|float|bool|null $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
		static $getOtherComparableValue = function (object $comparable): mixed {
			$comparableReflection = new \ReflectionClass($comparable);
			self::exceptionOnNonComparableTrait($comparableReflection);
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

	abstract protected function getComparableValue(): mixed;

	final public static function hasComparableTrait(object $object): bool
	{
		$reflectionClass = $object instanceof \ReflectionClass ?
			$object :
			(new \ReflectionClass($object));

		return isset($reflectionClass->getTraits()[ComparableTrait::class]);
	}

	final public static function exceptionOnNonComparableTrait(object $object): void
	{
		if (!self::hasComparableTrait($object)) {
			$message = 'Argument $object must have trait '.self::class;
			throw new \InvalidArgumentException($message);
		}
	}
}
