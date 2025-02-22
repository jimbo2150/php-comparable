<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Attribute\Comparable;
use Jimbo2150\PhpComparable\Enum\Operator;

#[Comparable()]
trait ComparableTrait
{
	#[Comparable()]
	public function compareTo(
		object $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
		$comparableReflection = new \ReflectionClass($comparable);
		if (!isset($comparableReflection->getTraits()[ComparableTrait::class])) {
			$message = 'Argument $comparable must have trait '.self::class;
			throw new \InvalidArgumentException($message);
		}

		/** @var ComparableTrait $comparable */
		return $operator->compare(
			$this->getComparableValue(),
			$comparableReflection->
				getMethod('getComparableValue')->
				invoke($comparable)
		);
	}

	abstract protected function getComparableValue(): mixed;
}
