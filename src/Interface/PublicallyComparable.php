<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Interface;

interface PublicallyComparable extends Comparable
{
	public function getComparableValue(): mixed;
}
