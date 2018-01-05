<?php

namespace Mock;

use \Phrity\Comparison\Equalable;
use \Phrity\Comparison\Comparable;
use \Phrity\Comparison\ComparisonTrait;
use \Phrity\Comparison\IncomparableException;

class ComparableObject implements Comparable
{
    use ComparisonTrait;

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function compare($that)
    {
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
