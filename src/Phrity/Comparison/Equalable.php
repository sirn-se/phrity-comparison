<?php

namespace Phrity\Comparison;

interface Equalable
{
    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $this is equal to $that
     * @throws IncomparableException  Must throw if $this can not be compared with $that
     */
    public function equals($that);
}
