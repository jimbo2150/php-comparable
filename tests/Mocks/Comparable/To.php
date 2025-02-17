<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable;

use Jimbo2150\PhpComparable\Interface\PrivatelyComparable;
use Jimbo2150\PhpComparable\Trait\PrivatelyComparableTrait;

final class To implements PrivatelyComparable
{
	use PrivatelyComparableTrait;

	public function __construct(private mixed $value)
	{
	}

	protected function getComparableValue(): mixed
	{
		return $this->value;
	}
}
