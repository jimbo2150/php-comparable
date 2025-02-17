<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Enum\Operator;

trait PrivatelyComparableTrait
{
	use PublicallyComparableTrait;

	public function compareFrom(mixed $leftValue, Operator $operator = Operator::EQUAL): bool|int
	{
		if ($leftValue instanceof \Closure) {
			return $leftValue($this->getComparableValue(), $operator);
		}

		return $operator->compare($leftValue, $this->getComparableValue());
	}

	abstract protected function getComparableValue(): mixed;
}
