[![Build Status](https://travis-ci.org/sirn-se/phrity-comparison.svg?branch=master)](https://travis-ci.org/sirn-se/phrity-comparison)
[![Coverage Status](https://coveralls.io/repos/github/sirn-se/phrity-comparison/badge.svg?branch=master)](https://coveralls.io/github/sirn-se/phrity-comparison?branch=master)

# Comparison

Interfaces and helper trait for comparing objects.

## Equalable interface

```php
$this->equals($that); // True if $this is equal to $that
```

## Comparable interface

Extends Equalable interface

```php
$this->greaterThan($that);        // True if $this is greater than $that
$this->greaterThanOrEqual($that); // True if $this is greater than or equal to $that
$this->lessThan($that);           // True if $this is less than $that
$this->lessThanOrEqual($that);    // True if $this is less than or equal to $that

//  0 if $this is equal to $that
// -1 if $this is less than $that
//  1 if $this is greater than $that
$this->compare($that);
```

## Comparison trait

A class using this trait only has to implement the `compare()` method. Enables the following methods:
```php
equals()
greaterThan()
greaterThanOrEqual()
lessThan()
lessThanOrEqual()
```