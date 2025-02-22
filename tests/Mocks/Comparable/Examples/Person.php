<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

class Person
{
	public function __construct(private string $name, private int $age)
	{
		assert($age > 0);
	}

	public function getComparableValue(): mixed
	{
		return $this->age;
	}
}
