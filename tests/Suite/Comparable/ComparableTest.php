<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\From;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\To;
use PHPUnit\Framework\TestCase;

final class ComparableTest extends TestCase
{
	public function testEquality()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Equal (==)
		$this->assertFalse(
			$from->compareTo($to),
			' integer 3 is not equal to integer 432'
		);
		$this->assertTrue(
			$from->compareTo($toEqual),
			'integer 3 is equal to integer 3'
		);
		$this->assertTrue(
			$from->compareTo($toEqualString),
			'integer 3 is equal to string \'3\''
		);
		$this->assertFalse(
			$from->compareTo($toString),
			'integer 3 is not equal to string \'42\''
		);
	}

	public function testIdentity()
	{
		$from = new From(3);
		$to = new To(432);
		$toString = new To('3');

		// Identical (===)
		$this->assertFalse(
			$from->compareTo($to, Operator::IDENTICAL),
			'integer 3 is not identical to integer 432'
		);
		$this->assertFalse(
			$from->compareTo($toString, Operator::IDENTICAL),
			'integer 3 is not identical to string \'3\''
		);
		$this->assertTrue(
			$from->compareTo($from, Operator::IDENTICAL),
			'integer 3 is identical to integer 3'
		);

		// NOT identical (!==)
		$this->assertTrue(
			$from->compareTo($to, Operator::NOT_IDENTICAL),
			'integer 3 is not identical to integer 432'
		);
		$this->assertTrue(
			$from->compareTo($toString, Operator::NOT_IDENTICAL),
			'integer 3 is not identical to string \'3\''
		);
		$this->assertFalse(
			$from->compareTo($from, Operator::NOT_IDENTICAL),
			'integer 3 is identical to integer 3'
		);
	}

	public function testInequality()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Not equal (!=)
		$this->assertTrue(
			$from->compareTo($to, Operator::NOT_EQUAL),
			'integer 3 is not equal to integer 432'
		);
		$this->assertFalse(
			$from->compareTo($toEqual, Operator::NOT_EQUAL),
			'integer 3 is equal to integer 3'
		);
		$this->assertFalse(
			$from->compareTo($toEqualString, Operator::NOT_EQUAL),
			'integer 3 is equal to string \'3\''
		);
		$this->assertTrue(
			$from->compareTo($toString, Operator::NOT_EQUAL),
			'integer 3 is not equal to string \'42\''
		);

		// Diamond operator, same as not equal (<>)
		$this->assertTrue(
			$from->compareTo($to, Operator::NOT_EQUAL_DIAMOND),
			'integer 3 is not equal to integer 432'
		);
		$this->assertFalse(
			$from->compareTo($toEqual, Operator::NOT_EQUAL_DIAMOND),
			'integer 3 is equal to integer 3'
		);
		$this->assertFalse(
			$from->compareTo(
				$toEqualString,
				Operator::NOT_EQUAL_DIAMOND
			),
			'integer 3 is equal to string \'3\''
		);
		$this->assertTrue(
			$from->compareTo($toString, Operator::NOT_EQUAL_DIAMOND),
			'integer 3 is not equal to string \'42\''
		);
	}

	public function testLessThan()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Less than (<)
		$this->assertTrue(
			$from->compareTo($to, Operator::LESS_THAN),
			'integer 3 is less than integer 432'
		);
		$this->assertFalse(
			$from->compareTo($toEqual, Operator::LESS_THAN),
			'integer 3 is not less than integer 3'
		);
		$this->assertFalse(
			$from->compareTo($toEqualString, Operator::LESS_THAN),
			'integer 3 is not less than string \'3\''
		);
		$this->assertTrue(
			$from->compareTo($toString, Operator::LESS_THAN),
			'integer 3 is less than string \'42\''
		);
	}

	public function testGreaterThan()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Greater than (>)
		$this->assertFalse(
			$from->compareTo($to, Operator::GREATER_THAN),
			'integer 3 is not greater than integer 432'
		);
		$this->assertFalse(
			$from->compareTo($toEqual, Operator::GREATER_THAN),
			'integer 3 is not greater than integer 3'
		);
		$this->assertFalse(
			$from->compareTo($toEqualString, Operator::GREATER_THAN),
			'integer 3 is not greater than string \'3\''
		);
		$this->assertFalse(
			$from->compareTo($toString, Operator::GREATER_THAN),
			'integer 3 is not greater than string \'42\''
		);
		$this->assertTrue(
			$toString->compareTo($from, Operator::GREATER_THAN),
			'string \'42\' is greater than integer 3'
		);
	}

	public function testLessThanOrEqual()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Less than or equal to (<=)
		$this->assertTrue(
			$from->compareTo($to, Operator::LESS_THAN_OR_EQUAL),
			'integer 3 is less than or equal to integer 432'
		);
		$this->assertTrue(
			$from->compareTo($toEqual, Operator::LESS_THAN_OR_EQUAL),
			'integer 3 is less than or equal to integer 3'
		);
		$this->assertTrue(
			$from->compareTo(
				$toEqualString,
				Operator::LESS_THAN_OR_EQUAL
			),
			'integer 3 is less than or equal to string \'3\''
		);
		$this->assertTrue(
			$from->compareTo($toString, Operator::LESS_THAN_OR_EQUAL),
			'integer 3 is less than or equal to string \'42\''
		);
		$this->assertFalse(
			$toString->compareTo($from, Operator::LESS_THAN_OR_EQUAL),
			'string \'42\' is not less than or equal to integer 3'
		);
	}

	public function testGreaterThanOrEqual()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Greater than or equal to (>=)
		$this->assertFalse(
			$from->compareTo($to, Operator::GREATER_THAN_OR_EQUAL),
			'integer 3 is not greater than equal to integer 432'
		);
		$this->assertTrue(
			$from->compareTo($toEqual, Operator::GREATER_THAN_OR_EQUAL),
			'integer 3 is greater than or equal to integer 3'
		);
		$this->assertTrue(
			$from->compareTo(
				$toEqualString,
				Operator::LESS_THAN_OR_EQUAL
			),
			'integer 3 is greater than or equal to string \'3\''
		);
		$this->assertFalse(
			$from->compareTo(
				$toString,
				Operator::GREATER_THAN_OR_EQUAL
			),
			'integer 3 is not greater than or equal to string \'42\''
		);
		$this->assertTrue(
			$toString->compareTo(
				$from,
				Operator::GREATER_THAN_OR_EQUAL
			),
			'string \'42\' is greater than or equal to integer 3'
		);
	}

	public function testSpaceship()
	{
		$from = new From(3);
		$to = new To(432);
		$toEqual = new To(3);
		$toEqualString = new To('3');
		$toString = new To('42');

		// Spaceship (<=>)
		$this->assertSame(-1,
			$from->compareTo($to, Operator::SPACESHIP),
			'integer 3 is -1 (less than) integer 432'
		);
		$this->assertSame(
			0,
			$from->compareTo($toEqual, Operator::SPACESHIP),
			'integer 3 is 0 (equal to) integer 3'
		);
		$this->assertSame(
			0,
			$from->compareTo(
				$toEqualString,
				Operator::SPACESHIP
			),
			'integer 3 is 0 (equal to) string \'3\''
		);
		$this->assertSame(-1,
			$from->compareTo(
				$toString,
				Operator::SPACESHIP
			),
			'integer 3 is -1 (less than) string \'42\''
		);
		$this->assertSame(
			1,
			$toString->compareTo(
				$from,
				Operator::SPACESHIP
			),
			'string \'42\' is 1 (greater than) integer 3'
		);
	}
}
