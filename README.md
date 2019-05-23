[![Build Status](https://travis-ci.org/sirn-se/phrity-comparison.svg?branch=master)](https://travis-ci.org/sirn-se/phrity-comparison)
[![Coverage Status](https://coveralls.io/repos/github/sirn-se/phrity-comparison/badge.svg?branch=master)](https://coveralls.io/github/sirn-se/phrity-comparison?branch=master)

# Comparison

Interfaces and helper trait for comparing objects.

Current version supports PHP `5.6` and `7.*`.

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

* `1.0` - `Equalable` and `Comparable` interface, `ComparisonTrait` trait
