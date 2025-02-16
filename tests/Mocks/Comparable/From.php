<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable;

use Jimbo2150\PhpComparable\Interface\Comparable;
use Jimbo2150\PhpComparable\Trait\ComparableTrait;

final class From implements Comparable
{
	use ComparableTrait;

	public function __construct(private mixed $value)
	{
	}

	protected function getComparableValue(): mixed
	{
		return $this->value;
	}
}
