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
    private $comparables;

    /**
     * If comparables supplied in constructor, they will be used as defaults an operations
     * @param  array $comparables     List of objects implementing Comparable
     */
    public function __construct(array $comparables = [])
    {
        $this->comparables = $comparables;
    }

    // Sort methods

    /**
     * Sorts array of comparable items, low to high
     * @param  array $comparables     List of objects implementing Comparable
     * @return array                  The sorted list
     * @throws IncomparableException  Thrown if any item in the list can not be compared
     */
    public function sort(array $comparables = null): array
    {
        $comparables = $comparables ?: $this->comparables;
        usort($comparables, function ($item_1, $item_2) {
            $this->verifyComparable($item_1);
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
    public function rsort(array $comparables = null): array
    {
        $comparables = $comparables ?: $this->comparables;
        usort($comparables, function ($item_1, $item_2) {
            $this->verifyComparable($item_2);
            return $item_2->compare($item_1);
        });
        return $comparables;
    }


    // Filter methods

    /**
     * Filter array of comparable items that equals condition
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function equals(Comparable $condition, array $comparables = null): array
    {
        return $this->applyFilter('equals', $condition, $comparables);
    }

    /**
     * Filter array of comparable items that are greater than condition
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function greaterThan(Comparable $condition, array $comparables = null): array
    {
        return $this->applyFilter('greaterThan', $condition, $comparables);
    }

    /**
     * Filter array of comparable items that are greater than or equals condition
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function greaterThanOrEqual(Comparable $condition, array $comparables = null): array
    {
        return $this->applyFilter('greaterThanOrEqual', $condition, $comparables);
    }

    /**
     * Filter array of comparable items that are less than condition
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function lessThan(Comparable $condition, array $comparables = null): array
    {
        return $this->applyFilter('lessThan', $condition, $comparables);
    }

    /**
     * Filter array of comparable items that are less than or equals condition
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function lessThanOrEqual(Comparable $condition, array $comparables = null): array
    {
        return $this->applyFilter('lessThanOrEqual', $condition, $comparables);
    }


    // Select methods

    /**
     * Get minimum item from array of comparable items
     * @param  array      $comparables  List of objects implementing Comparable
     * @return Comparable               The resolved instance
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function min(array $comparables = null): ?Comparable
    {
        return $this->applyReduction('lessThan', $comparables);
    }

    /**
     * Get maximum item from array of comparable items
     * @param  array      $comparables  List of objects implementing Comparable
     * @return Comparable               The resolved instance
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    public function max(array $comparables = null): ?Comparable
    {
        return $this->applyReduction('greaterThan', $comparables);
    }


    // Private internal methods

    /**
     * Verify input implements Comparable
     * @param  Comparable $item       Item to verify
     * @throws IncomparableException  Thrown if item do not implement Comparable
     */
    private function verifyComparable($item): void
    {
        if (!$item instanceof Comparable) {
            throw new IncomparableException('All items must implement Comparable');
        }
    }

    /**
     * Filter array of comparable items according to condition instance and method
     * @param  string     $method       Comparison method to use
     * @param  Comparable $condition    To compare against
     * @param  array      $comparables  List of objects implementing Comparable
     * @return array                    The filtered list
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    private function applyFilter($method, Comparable $condition, array $comparables = null): array
    {
        $comparables = $comparables ?: $this->comparables;
        $filtered = array_filter($comparables, function ($item) use ($method, $condition) {
            $this->verifyComparable($item);
            return $item->$method($condition);
        });
        return array_values($filtered);
    }

    /**
     * Reduce array of comparable items according comparison method
     * @param  string     $method       Comparison method to use
     * @param  array      $comparables  List of objects implementing Comparable
     * @return Comparable               The resolved instance
     * @throws IncomparableException    Thrown if any item in the list can not be compared
     */
    private function applyReduction($method, array $comparables = null): ?Comparable
    {
        $comparables = $comparables ?: $this->comparables;
        return array_reduce($comparables, function ($item_1, $item_2) use ($method) {
            if (is_null($item_1)) {
                return $item_2;
            }
            $this->verifyComparable($item_1);
            return $item_1->$method($item_2) ? $item_1 : $item_2;
        });
    }
}
