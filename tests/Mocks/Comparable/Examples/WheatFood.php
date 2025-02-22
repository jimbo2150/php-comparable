<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

class WheatFood
{
	/** The value to compare */
	private $food = 'pasta';

	public function __construct(private string $type)
	{
	}

	public function getComparableValue(): mixed
	{
		return [$this->food, $this->type];
	}
}
