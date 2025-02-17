<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

use Jimbo2150\PhpComparable\Interface\PublicallyComparable;
use Jimbo2150\PhpComparable\Trait\PublicallyComparableTrait;

class GreenFood implements PublicallyComparable
{
	use PublicallyComparableTrait;

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
