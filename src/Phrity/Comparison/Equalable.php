<?php
/**
 * File for Equalable inteface.
 * Part of Phrity/Comparison package.
 */
namespace Phrity\Comparison;

/**
 * Interface for equalable instances.
 */
interface Equalable
{
    /**
     * If $this is equal to $that.
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $this is equal to $that
     * @throws IncomparableException  Must throw if $this can not be compared with $that
     */
    public function equals($that);
}
