<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
final class Comparable
{
	public function __construct()
	{
	}
}
