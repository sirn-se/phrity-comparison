[![Build Status](https://travis-ci.org/sirn-se/phrity-comparison.svg?branch=master)](https://travis-ci.org/sirn-se/phrity-comparison)
[![Coverage Status](https://coveralls.io/repos/github/sirn-se/phrity-comparison/badge.svg?branch=master)](https://coveralls.io/github/sirn-se/phrity-comparison?branch=master)

# Comparison

Interfaces and helper trait for comparing objects.

## Equalable interface

```php
$this->equals($that); // True if $that is equal to $this
```

## Comparable interface (extends Equalable interface)

```php
$this->greaterThan($that); // True if $that is greater than $this
$this->greaterThanOrEqual($that); // True if $that is greater than or equal to $this
$this->lessThan($that); // True if $that is less than $this
$this->lessThanOrEqual($that); // True if $that is less than or equal to $this

// 0 if $that is equal to $this
// -1 if $that is less than $this
// 1 if $that is greater than $this
$this->compare($that);
```

## Comparsion trait

A class using this trait only has to implement the compare() method.

Methods equals(), greaterThan(), greaterThanOrEqual(), lessThan() and lessThanOrEqual() will be provided by the trait, based on the result of compare().
