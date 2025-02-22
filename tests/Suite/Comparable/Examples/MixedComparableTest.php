<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\GreenFood;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\Person;
use PHPUnit\Framework\TestCase;

final class MixedComparableTest extends TestCase
{
	public function testMixedComparable()
	{
		$cobbSalad = new GreenFood('cobb');
		$john = new Person('John', 34);

		$this->assertFalse(
			$cobbSalad->compareTo($john),
			'Cobb salad must not be the same as John.'
		);
	}
}
