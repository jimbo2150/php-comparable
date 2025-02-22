<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable;

final class NonComparable
{
	public function __construct(private mixed $value)
	{
	}

	protected function getComparableValue(): mixed
	{
		return $this->value;
	}
}
