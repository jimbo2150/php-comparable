<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Trait;

use Jimbo2150\PhpComparable\Attribute\Comparable;
use Jimbo2150\PhpComparable\Enum\Operator;

trait ComparableTrait
{
	#[Comparable()]
	public function compareTo(
		\stdClass $comparable,
		Operator $operator = Operator::EQUAL,
	): bool|int {
	}

	abstract protected function getComparableValue(): mixed;
}
