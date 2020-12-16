[![Build Status](https://travis-ci.com/sirn-se/phrity-comparison.svg?branch=master)](https://travis-ci.com/sirn-se/phrity-comparison)
[![Coverage Status](https://coveralls.io/repos/github/sirn-se/phrity-comparison/badge.svg?branch=master)](https://coveralls.io/github/sirn-se/phrity-comparison?branch=master)

# Comparison

Interfaces and helper trait for comparing objects. Comparator utility class for sort and filter applications.

Current version supports PHP `^7.1|^8.0`.

## Installation

Install with [Composer](https://getcomposer.org/);
```
composer require phrity/comparison
```

## The Equalable interface

###  Interface synopsis

```php
interface Phrity\Comparison\Equalable {

    /* Abstract methods */
    abstract public equals(mixed $compare_with) : bool
}
```

###  Examples

```php
// $a must implement Equalable, $b can be anything
$a->equals($b); // True if $a is equal to $b
```

## The Comparable interface

Extends `Equalable` interface.

###  Interface synopsis

```php
interface Phrity\Comparison\Comparable
    extends Phrity\Comparison\Equalable {

    /* Abstract methods */
    abstract public greaterThan(mixed $compare_with) : bool
    abstract public greaterThanOrEqual(mixed $compare_with) : bool
    abstract public lessThan(mixed $compare_with) : bool
    abstract public lessThanOrEqual(mixed $compare_with) : bool
    abstract public compare(mixed $compare_with) : int

    /* Inherited from Equalable */
    abstract public equals(mixed $compare_with) : bool
}
```

###  Examples

```php
// $a must implement Comparable, $b can be anything
$a->greaterThan($b);        // True if $a is greater than $b
$a->greaterThanOrEqual($b); // True if $a is greater than or equal to $b
$a->lessThan($b);           // True if $a is less than $b
$a->lessThanOrEqual($b);    // True if $a is less than or equal to $b

//  0 if $a is equal to $b
// -1 if $a is less than $b
//  1 if $a is greater than $b
$a->compare($b);
```

## The ComparisonTrait trait

A class using this trait only has to implement the `compare()` method. Enables all other methods in `Equalable` and `Comparable` intefaces.

###  Trait synopsis

```php
trait Phrity\Comparison\ComparisonTrait
    implements Phrity\Comparison\Comparable {

    /* Methods */
    public equals(mixed $compare_with) : bool
    public greaterThan(mixed $compare_with) : bool
    public greaterThanOrEqual(mixed $compare_with) : bool
    public lessThan(mixed $compare_with) : bool
    public lessThanOrEqual(mixed $compare_with) : bool

    /* Inherited from Comparable */
    abstract public compare(mixed $compare_with) : int
}
```

## The Comparator class

Utility class to sort and filter array objects that implement the `Comparable` interface.

###  Class synopsis

```php
class Phrity\Comparison\Comparator {

    /* Methods */
    public __construct(array $comparables = null)
    public sort(array $comparables = null) : array
    public rsort(array $comparables = null) : array
    public equals(Comparable $condition, array $comparables = null) : array
    public greaterThan(Comparable $condition, array $comparables = null) : array
    public greaterThanOrEqual(Comparable $condition, array $comparables = null) : array
    public lessThan(Comparable $condition, array $comparables = null) : array
    public lessThanOrEqual(Comparable $condition, array $comparables = null) : array
    public min(array $comparables = null) : Comparable
    public max(array $comparables = null) : Comparable
}
```

###  Examples

```php
$comparables = [$v2, $v1, $v4, $v3];
$condition = $v3;
$comparator = new Comparator();

// Sort and reverse sort array of Comparable
$comparator->sort($comparables); // [$v1, $v2, $v3, $v4]
$comparator->rsort($comparables); // [$v4, $v3, $v2, $v1]

// Filter array of Comparable using a Comparable as condition
$comparator->equals($condition, $comparables); // [$v3]
$comparator->greaterThan($condition, $comparables); // [$v4]
$comparator->greaterThanOrEqual($condition, $comparables); // [$v4, $v3]
$comparator->lessThan($condition, $comparables); // [$v2, $v1]
$comparator->lessThanOrEqual($condition, $comparables); // [$v2, $v1, $v3]

// Select min/max instance
$comparator->min($comparables); // $v1
$comparator->max($comparables); // $v4

// Can also "store" comparables for re-use in multiple operations
$comparables = [$v2, $v1, $v4, $v3];
$comparator = new Comparator($comparables);
$comparator->sort(); // [$v1, $v2, $v3, $v4]
$comparator->equals($condition); // [$v3]
$comparator->min(); // $v1
```

## The IncomparableException class

Must be thrown if comparison methods receive input they can not compare with.

###  Class synopsis

```php
class Phrity\Comparison\IncomparableException
    extends InvalidArgumentException {

    /* Inherited from InvalidArgumentException */
    public __construct([string $message = '' [, int $code = 0 [, Throwable $previous = null]]])
    public getMessage() : string
    public getPrevious() : Throwable
    public getCode() : mixed
    public getFile() : string
    public getLine() : int
    public getTrace() : array
    public getTraceAsString() : string
    public __toString() : string
}
```


## Versions

| Version | PHP | |
| --- | --- | --- |
| `1.3` | `^7.1\|^8.0` |  |
| `1.2` | `^7.1` | The `Comparator` supports stored content for multiple operations |
| `1.1` | `>=5.6` | The `Comparator` class for sort and filter |
| `1.0` | `>=5.6` | `Equalable` and `Comparable` interface, `ComparisonTrait` trait |
