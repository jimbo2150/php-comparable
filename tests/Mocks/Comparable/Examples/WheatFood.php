<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

use Jimbo2150\PhpComparable\Trait\ComparableTrait;

class WheatFood
{
	use ComparableTrait;

	/** The value to compare */
	private $food = 'pasta';

	public function __construct(private string $type)
	{
	}

	public function getComparableValue(): mixed
	{
		return [static::class, $this->food, $this->type];
	}
}
