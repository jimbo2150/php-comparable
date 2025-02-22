<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\GreenFood;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\Person;
use PHPUnit\Framework\TestCase;

final class MixedComparableTest extends TestCase
{
	/**
	 * Ensure comparisons using arrays with unequal values return correct values.
	 */
	public function testMixedComparable()
	{
		$cobbSalad = new GreenFood('cobb');
		$john = new Person('John', 34);

		$this->assertFalse(
			$cobbSalad->compareTo($john),
			'Cobb salad must not be the same as John.'
		);
	}

	/**
	 * Ensure comparisons using arrays with some same values return correct values.
	 */
	public function testMixedComparableSimilar()
	{
		$cobbSalad = new GreenFood('cobb salad');
		$john = new GreenFood('chef salad');

		$this->assertFalse(
			$cobbSalad->compareTo($john),
			'Cobb salad must not be the same as chef salad.'
		);
	}

	/**
	 * Ensure comparisons using arrays with equal values return correct values.
	 */
	public function testMixedComparableSame()
	{
		$chef_salad_1 = new GreenFood('chef salad');
		$chef_salad_2 = new GreenFood('chef salad');

		$this->assertTrue(
			$chef_salad_1->compareTo($chef_salad_2),
			'Chef salad must be the same as chef salad.'
		);
	}
}
