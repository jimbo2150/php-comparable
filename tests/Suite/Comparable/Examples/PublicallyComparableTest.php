<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Tests\Suite\Comparable;

use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\GreenFood;
use Jimbo2150\PhpComparable\Tests\Mocks\Comparable\Examples\WheatFood;
use PHPUnit\Framework\TestCase;

final class PublicallyComparableTest extends TestCase
{
	public function testFood()
	{
		$cobbSalad = new GreenFood('cobb');
		$chefSalad = new GreenFood('chef');
		$pasta = new WheatFood('spaghetti');
		$pasta2 = new WheatFood('spaghetti');

		$this->assertFalse(
			$cobbSalad->compareTo($chefSalad),
			'Cobb salad is not the same as Chef salad.'
		);
		$this->assertTrue(
			$pasta->compareTo($pasta2),
			'Spaghetti must be equal to spaghetti.'
		);
	}
}
