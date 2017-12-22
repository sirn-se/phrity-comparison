<?php

namespace Phrity\Comparison;

interface Comparable extends Equalable
{
    /**
     * @param  mixed $that            The instance to compare with
     * @return integer                Must return 0 if $that is equal to $this
     *                                Must return -1 if $that is less than $this
     *                                Must return 1 if $that is greater than $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function compare($that);

    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $that is greater than $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function greaterThan($that);

    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $that is greater than or equal to $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function greaterThanOrEqual($that);

    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $that is less than $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function lessThan($that);

    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $that is less than or equal to $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function lessThanOrEqual($that);
}
