<?php
/**
 * File for Comparator.
 * @package Phrity > Comparison
 */
namespace Phrity\Comparison;

/**
 * Utility class for comparing and filtering.
 */
class Comparator
{
    /**
     * Sorts array of comparable items, low to high
     * @param  array $comparables     List of objects implementing Comparable
     * @return array                  The sorted list
     * @throws IncomparableException  Thrown if any item in the list can not be compared
     */
    public function sort(array $comparables)
    {
        usort($comparables, function ($item_1, $item_2) {
            if (!$item_1 instanceof Comparable) {
                throw new IncomparableException('Items are nor comparable');
            }
            return $item_1->compare($item_2);
        });
        return $comparables;
    }

    /**
     * Sorts array of comparable items, high to low
     * @param  array $comparables     List of objects implementing Comparable
     * @return array                  The sorted list
     * @throws IncomparableException  Thrown if any item in the list can not be compared
     */
    public function rsort(array $comparables)
    {
        usort($comparables, function ($item_1, $item_2) {
            if (!$item_2 instanceof Comparable) {
                throw new IncomparableException('Items are nor comparable');
            }
            return $item_2->compare($item_1);
        });
        return $comparables;
    }

    /**
     * Filter array of comparable items greater than condition
     * @param  Comparable $condition  To compare against
     * @param  array $comparables     List of objects implementing Comparable
     * @throws IncomparableException  Thrown if any item in the list can not be compared
     */
    public function greaterThan(Comparable $condition, array $comparables)
    {
        $filtered = array_filter($comparables, function ($item) use ($condition) {
            return $item->greaterThan($condition);
        });
        return array_values($filtered);
    }

    /**
     * Filter array of comparable items greater than or equals condition
     * @param  Comparable $condition  To compare against
     * @param  array $comparables     List of objects implementing Comparable
     * @throws IncomparableException  Thrown if any item in the list can not be compared
     */
    public function greaterThanOrEqual(Comparable $condition, array $comparables)
    {
        $filtered = array_filter($comparables, function ($item) use ($condition) {
            return $item->greaterThanOrEqual($condition);
        });
        return array_values($filtered);
    }







    /**
     * If $this is less than $that.
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $this is less than $that
     * @throws IncomparableException  Thrown if $this can not be compared with $that
     */
    public function lessThan($that)
    {
        return $this->compare($that) < 0;
    }

    /**
     * If $this is less than or equal to $this.
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $this is less than or equal to $this
     * @throws IncomparableException  Thrown if $this can not be compared with $that
     */
    public function lessThanOrEqual($that)
    {
        return $this->compare($that) <= 0;
    }
}
