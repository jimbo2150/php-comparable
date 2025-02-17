<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Interface;

use Jimbo2150\PhpComparable\Enum\Operator;

interface Comparable
{
	public function compareTo(Comparable $other, Operator $operator = Operator::EQUAL): bool|int;
}
