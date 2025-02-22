<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\Score;
use PHPUnit\Framework\TestCase;

final class CustomComparableTest extends TestCase
{
	public function testCustomDiff()
	{
		$score1 = new Score(2.3);
		$score2 = new Score(34);
		$score3 = new Score(0.3);

		$this->assertFalse(
			$score1->compareDiff($score2),
			'2.3 - 34 must not be more than 1'
		);
		$this->assertTrue(
			$score1->compareDiff($score3),
			'2.3 - 0.3 must be more than 1'
		);
	}
}
