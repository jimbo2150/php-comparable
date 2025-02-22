<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;

trait ComparableTrait
{
	public function compareTo(
		object $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
		$comparableReflection = new \ReflectionClass($comparable);
		self::exceptionOnNonComparableTrait($comparableReflection);
		/** @var ComparableTrait $comparable */

		return $operator->compare(
			$this->getComparableValue(),
			$comparableReflection->
				getMethod('getComparableValue')->
				invoke($comparable)
		);
	}

	abstract protected function getComparableValue(): mixed;

	final public static function hasComparableTrait(\ReflectionClass $comparableReflection): bool
	{
		return isset($comparableReflection->getTraits()[ComparableTrait::class]);
	}

	final public static function exceptionOnNonComparableTrait(
		\ReflectionClass $comparableReflection,
	): void {
		if (!self::hasComparableTrait($comparableReflection)) {
			$message = 'Argument $comparable must have trait '.self::class;
			throw new \InvalidArgumentException($message);
		}
	}
}
