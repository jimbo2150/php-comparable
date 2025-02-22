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
		$compareValue = $comparable;
		if (is_object($comparable)) {
			$comparableReflection = new \ReflectionClass($comparable);
			self::exceptionOnNonComparableTrait($comparableReflection);
			/** @var ComparableTrait $comparable */
			$compareValue = $comparableReflection->
				getMethod('getComparableValue')->
				invoke($comparable);
		}

		return $operator->compare($this->getComparableValue(), $compareValue);
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
