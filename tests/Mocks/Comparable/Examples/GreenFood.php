<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

use Jimbo2150\PhpComparable\Trait\ComparableTrait;

class GreenFood
{
	use ComparableTrait;

	/** The value to compare */
	private string $food = 'salad';

	public function __construct(private string $type)
	{
	}

	public function getComparableValue(): mixed
	{
		return [$this->food, $this->type];
	}
}
