<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Interface\Comparable;
use Jimbo2150\PhpComparable\Interface\PublicallyComparable;

trait PublicallyComparableTrait
{
	public function compareTo(Comparable $other, Operator $operator = Operator::EQUAL): bool|int
	{
		if ($other instanceof PublicallyComparable) {
			return $operator->compare(
				$this->getComparableValue(), $other->getComparableValue()
			);
		}

		return $other->compareFrom($this->getComparableValue(), $operator);
	}
}
