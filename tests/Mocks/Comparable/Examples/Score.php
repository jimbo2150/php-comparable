<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Trait\ComparableTrait;

class Score
{
	use ComparableTrait;

	public const MIN_REQUIRED_SCORE = 1;

	public function __construct(private float $score)
	{
	}

	public function compareDiff(object $other): bool|int
	{
		$operator = Operator::GREATER_THAN_OR_EQUAL;
		$diffFunction = fn (
			mixed $leftValue,
			mixed $rightValue,
			Operator $operator,
		): bool|int => $operator->compare(
			$leftValue - $rightValue,
			self::MIN_REQUIRED_SCORE
		);

		return $this->customCompareTo(
			$diffFunction,
			$other,
			$operator
		);
	}

	public function getComparableValue(): mixed
	{
		return $this->score;
	}
}
