<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Enum\Operator;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Comparable;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\NonComparable;
use PHPUnit\Framework\TestCase;

final class ComparableTest extends TestCase
{
	/**
	 * Ensure comparisons using standard equality (==) return correct values.
	 */
	public function testEquality(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure an exception is thrown when an attempt is made to compare a
	 * non-comparable object to a comparable object.
	 */
	public function testNonComparable()
	{
		$comparable = new Comparable(3);
		$nonComparable = new NonComparable(432);

		// Exception thrown
		$this->expectException(\InvalidArgumentException::class);
		$comparable->compareTo($nonComparable);
	}

	/**
	 * Ensure comparisons using strict identity (===) return correct values.
	 */
	public function testIdentity(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toString = new Comparable('3');

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

	/**
	 * Ensure comparisons using inequality (!=) return correct values.
	 */
	public function testInequality(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure comparisons using less than (<) return correct values.
	 */
	public function testLessThan(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure comparisons using greater than (>) return correct values.
	 */
	public function testGreaterThan(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure comparisons using less than or equal to (<=) return correct values.
	 */
	public function testLessThanOrEqual(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure comparisons using greater than or equal to (>=) return correct values.
	 */
	public function testGreaterThanOrEqual(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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

	/**
	 * Ensure comparisons using the spaceship operator (<=>) return correct values.
	 */
	public function testSpaceship(): void
	{
		$from = new Comparable(3);
		$to = new Comparable(432);
		$toEqual = new Comparable(3);
		$toEqualString = new Comparable('3');
		$toString = new Comparable('42');

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
