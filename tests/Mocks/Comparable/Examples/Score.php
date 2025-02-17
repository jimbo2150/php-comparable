<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Interface\PrivatelyComparable;
use Jimbo2150\PhpComparable\Interface\PublicallyComparable;
use Jimbo2150\PhpComparable\Trait\PrivatelyComparableTrait;

class Score implements PrivatelyComparable
{
	use PrivatelyComparableTrait;

	public const MIN_REQUIRED_SCORE = 1;

	public function __construct(private float $score)
	{
	}

	public function compareDiff(PrivatelyComparable|PublicallyComparable $other): bool|int
	{
		$leftValue = $this->getComparableValue();
		$operator = Operator::GREATER_THAN_OR_EQUAL;
		$callback = fn (
			mixed $rightValue,
			Operator $operator,
		): bool|int => $operator->compare(
			$leftValue - $rightValue,
			self::MIN_REQUIRED_SCORE
		);

		if ($other instanceof PublicallyComparable) {
			return $callback($other->getComparableValue(), $operator);
		}

		return $other->compareFrom($callback, $operator);
	}

	public function getComparableValue(): mixed
	{
		return $this->score;
	}
}
