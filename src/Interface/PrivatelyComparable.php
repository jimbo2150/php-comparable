<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Interface;

use Jimbo2150\PhpComparable\Enum\Operator;

interface PrivatelyComparable extends Comparable
{
	public function compareFrom(mixed $leftValue, Operator $operator = Operator::EQUAL): bool|int;
}
