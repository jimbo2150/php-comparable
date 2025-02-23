![Version](https://img.shields.io/github/v/release/jimbo2150/php-comparable)
![License](https://img.shields.io/github/license/jimbo2150/php-comparable)
![PHP Required Version](https://img.shields.io/packagist/dependency-v/jimbo2150/php-comparable/php)

# PHP Comparable Objects Trait & Custom Comparison Convenience Method

A PHP library to allow for comparison of two objects with a comparison operator.

This library allows you to compare two objects using a value within the objects rather than the entirety of the object (the default for PHP).

## Installation

This library is available on Packagist using Composer. Run this command within your composer project directory:

```bash
$ composer require jimbo2150/php-comparable
```

## Usage (private value with convenience trait)

The comparable trait (`ComparableTrait`) requires a protected method, `getComparableValue()`, which does not publically expose the value to be compared. The convenience methods then use reflection to access the other object's value:

```php
use Jimbo2150\PhpComparable\Trait\ComparableTrait;

// This class will compare the Person object's $age property.
class Person
{
	use ComparableTrait;

	public function __construct(private string $name, private int $age)
	{
		assert($age > 0);
	}

	public function getComparableValue(): mixed
	{
		return $this->age;
	}
}

$john = new Person('John', 29);
$karen = new Person('Karen', 24);

$john->compareTo($karen); // False, compares by equals (==) by default
$karen->compareTo($john, Operator::from('<')); // True, comparing with less than
```

## Usage (private value with custom comparison)

You can also implement your own custom compare method by creating your own comparison method that utilizes the `customCompareTo(callable $callback, ComparableTrait $compareTo, Operator $operator)` convenience method and provide a callback (callable or Closure) that, when called, is passed the current object's comparison value, the comparison value of the object your are comparing to, and the operator as parameter values:

```php
use Jimbo2150\PhpComparable\Trait\ComparableTrait;

class Score
{
	use ComparableTrait;

	public const MIN_REQUIRED_SCORE = 1;

	public function __construct(private float $score)
	{
	}

	public function compareDiff(object $other): bool|int
	{
		$operator = Operator::GREATER_THAN_OR_EQUAL;
		$diffFunction = fn (
			mixed $leftValue,
			mixed $rightValue,
			Operator $operator,
		): bool|int => $operator->compare(
			$leftValue - $rightValue,
			self::MIN_REQUIRED_SCORE
		);

		return $this->customCompareTo(
			$diffFunction,
			$other,
			$operator
		);
	}

	public function getComparableValue(): mixed
	{
		return $this->score;
	}
}

$score1 = new Score(2.4);
$score2 = new Score(0.7);
$score3 = new Score(0.2);

$score1->compareDiff($score2); // True, score is >= 1
$score2->compareDiff($score3); // False, score is less than 1
```