<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Enum;

use Jimbo2150\PhpComparable\Enum\Operator;
use PHPUnit\Framework\TestCase;

final class OperatorTest extends TestCase
{
	public function testFromName()
	{
		$this->assertSame(
			Operator::EQUAL,
			Operator::tryFrom('=='),
			'Operator should be EQUAL'
		);
		$this->assertSame(
			Operator::IDENTICAL,
			Operator::tryFrom('==='),
			'Operator should be IDENTICAL'
		);
		$this->assertSame(
			Operator::NOT_EQUAL,
			Operator::tryFrom('!='),
			'Operator should be NOT EQUAL'
		);
		$this->assertSame(
			Operator::NOT_EQUAL_DIAMOND,
			Operator::tryFrom('<>'),
			'Operator should be NOT EQUAL (DIAMOND)'
		);
		$this->assertSame(
			Operator::NOT_IDENTICAL,
			Operator::tryFrom('!=='),
			'Operator should be NOT_IDENTICAL'
		);
		$this->assertSame(
			Operator::LESS_THAN,
			Operator::tryFrom('<'),
			'Operator should be LESS THAN'
		);
		$this->assertSame(
			Operator::GREATER_THAN,
			Operator::tryFrom('>'),
			'Operator should be GREATER THAN'
		);
		$this->assertSame(
			Operator::LESS_THAN_OR_EQUAL,
			Operator::tryFrom('<='),
			'Operator should be LESS THAN OR EQUAL'
		);
		$this->assertSame(
			Operator::GREATER_THAN_OR_EQUAL,
			Operator::tryFrom('>='),
			'Operator should be GREATER THAN OR EQUAL'
		);
		$this->assertSame(
			Operator::SPACESHIP,
			Operator::tryFrom('<=>'),
			'Operator should be SPACESHIP'
		);
	}
}
