<?php

/**
 * File for mock class.
 * @package Phrity > Comparison
 */

namespace Mock;

use Phrity\Comparison\{
    Comparable,
    ComparisonTrait,
    IncomparableException,
};

/**
 * Mock class for comparison tests.
 */
class ComparableObject implements Comparable
{
    use ComparisonTrait;

    /**
     * A value used for comparison
     */
    private mixed $value;

    /**
     * Constructor for mock class
     * @param  mixed $value A value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * Compare $this and $that and return result as comparison identifier as integer.
     * @param  mixed $that            The instance to compare with
     * @return integer                Must return  0 if $this is equal to $that
     *                                Must return -1 if $this is less than $that
     *                                Must return  1 if $this is greater than $that
     * @throws IncomparableException  Must throw if $this can not be compared with $that
     */
    public function compare(mixed $that): int
    {
        if (!$that instanceof self) {
            throw new IncomparableException('Can not be compared');
        }
        if (!is_integer($that->value)) {
            throw new IncomparableException('Can not be compared');
        }
        if ($this->value < $that->value) {
            return -1;
        }
        if ($this->value > $that->value) {
            return 1;
        }
        return 0;
    }
}
