<?php

namespace Phrity\Comparison;

trait ComparisonTrait
{
    /// @see Phrity\Comparison\Equalable
    public function equals($that)
    {
        return $this->compare($that) == 0;
    }

    /// @see Phrity\Comparison\Comparable
    public function greaterThan($that)
    {
        return $this->compare($that) > 0;
    }

    /// @see Phrity\Comparison\Comparable
    public function greaterThanOrEqual($that)
    {
        return $this->compare($that) >= 0;
    }

    /// @see Phrity\Comparison\Comparable
    public function lessThan($that)
    {
        return $this->compare($that) < 0;
    }

    /// @see Phrity\Comparison\Comparable
    public function lessThanOrEqual($that)
    {
        return $this->compare($that) <= 0;
    }
}
