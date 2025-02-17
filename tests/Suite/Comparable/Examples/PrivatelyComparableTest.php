<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\Person;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\Score;
use PHPUnit\Framework\TestCase;

final class PrivatelyComparableTest extends TestCase
{
	public function testPersonAge()
	{
		$john = new Person('John', 29);
		$karen = new Person('Karen', 24);

		$this->assertFalse(
			$john->compareTo($karen),
			'Karen\'s age (24) is not equal to John\s age (29).'
		);
		$this->assertTrue(
			$karen->compareTo($john, Operator::from('<')),
			'Karen (24) is not older than John (29).'
		);
	}

	public function testCustomCompare()
	{
		$score1 = new Score(2.4);
		$score2 = new Score(0.7);
		$score3 = new Score(0.2);

		$this->assertTrue(
			$score1->compareDiff($score2),
			'Score difference must be greater than or equal to 1'
		);
		$this->assertFalse(
			$score2->compareDiff($score3),
			'Score must be less than one.'
		);
	}
}
