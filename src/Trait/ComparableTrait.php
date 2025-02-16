<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Interface\Comparable;

trait ComparableTrait
{
	public function compareTo(Comparable $other, Operator $operator = Operator::EQUAL): bool|int
	{
		return $other->compareFrom($this->getComparableValue(), $operator);
	}

	public function compareFrom(mixed $leftValue, Operator $operator = Operator::EQUAL): bool|int
	{
		return $operator->compare($leftValue, $this->getComparableValue());
	}

	abstract protected function getComparableValue(): mixed;
}
