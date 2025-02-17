![Version](https://img.shields.io/github/v/release/jimbo2150/php-comparable)
![License](https://img.shields.io/github/license/jimbo2150/php-comparable)
![PHP Required Version](https://img.shields.io/packagist/dependency-v/jimbo2150/php-comparable/php)

# PHP Comparable Interface & Convenience Trait

A PHP library to allow for comparison of two objects with a comparison operator.

This library allows you to compare two objects using a value within the objects rather than the entirety of the object (the default for PHP).

## Installation

This library is available on Packagist using Composer. Run this command within your composer project directory:

```bash
$ composer require jimbo2150/php-comparable
```

## Usage (private value with convenience trait)

The privately comparable interface requires a protected method, `getComparableValue()`, which does not publically expose the value to be compared:

```php
use Jimbo2150\PhpComparable\Interface\PrivatelyComparable;
use Jimbo2150\PhpComparable\Trait\PrivatelyComparableTrait;
use Jimbo2150\PhpComparable\Enum\Operator;

class Person implements PrivatelyComparable {
	use PrivatelyComparableTrait;

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

## Usage (publicly-visible value with convenience trait)

The publically comparable interface requires a public method `getComparableValue()` which exposes the value to be compared:

```php
use Jimbo2150\PhpComparable\Interface\PublicallyComparable;
use Jimbo2150\PhpComparable\Trait\PublicallyComparableTrait;

class GreenFood implements PublicallyComparable {
	use PublicallyComparableTrait;

	/** The value to compare */
	private string $food = 'salad';

	public function __construct(private string $type)
	{

	}

	public function getComparableValue(): mixed
	{
		return [$this->food, $this->type];
	}

}

class WheatFood implements PublicallyComparable {
	use PublicallyComparableTrait;

	/** The value to compare */
	private $food = 'pasta';

	public function __construct(private string $type)
	{

	}

	public function getComparableValue(): mixed
	{
		return [$this->food, $this->type];
	}

}

$cobbSalad = new GreenFood('cobb');
$chefSalad = new GreenFood('chef');
$pasta = new WheatFood('spaghetti');
$pasta2 = new WheatFood('spaghetti');

$cobbSalad->compareTo($chefSalad); // false
$pasta->compareTo($pasta2); // true
```

## Usage (private value with custom comparison)

You can also implement your own custom compare function by implementing both `compareTo()` and `compareFrom()` methods:

```php
use Jimbo2150\PhpComparable\Interface\PrivatelyComparable;
use Jimbo2150\PhpComparable\Trait\PrivatelyComparableTrait;

class Score implements PrivatelyComparable
{
	use PrivatelyComparableTrait;

	public const MIN_REQUIRED_SCORE = 1;

	public function __construct(private float $score)
	{
	}

	public function compareDiff(PrivatelyComparable|PublicallyComparable $other): bool|int
	{
		$leftValue = $this->getComparableValue();
		$operator = Operator::GREATER_THAN_OR_EQUAL;
		$callback = fn (
			mixed $rightValue,
			Operator $operator,
		) => $operator->compare(
			$leftValue - $rightValue,
			self::MIN_REQUIRED_SCORE
		);

		if ($other instanceof PublicallyComparable) {
			return $callback($other->getComparableValue(), $operator);
		}

		return $other->compareFrom($callback, $operator);
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