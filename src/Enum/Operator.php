<?php

declare(strict_types=1);

namespace Jimbo2150\PhpComparable\Enum;

enum Operator: string
{
	case EQUAL = '==';
	case IDENTICAL = '===';
	case NOT_EQUAL = '!=';
	case NOT_EQUAL_DIAMOND = '<>';
	case NOT_IDENTICAL = '!==';
	case LESS_THAN = '<';
	case GREATER_THAN = '>';
	case LESS_THAN_OR_EQUAL = '<=';
	case GREATER_THAN_OR_EQUAL = '>=';
	case SPACESHIP = '<=>';
}
