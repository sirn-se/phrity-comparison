<?php

namespace Phrity\Comparison;

interface Equalable
{
    /**
     * @param  mixed $that            The instance to compare with
     * @return boolean                True if $that is equal to $this
     * @throws IncomparableException  Must throw if $that can not be compared with $this
     */
    public function equals($that);
}
