<?php

namespace Bermuda\Filter;

/**
 * IntFilter
 *
 * This filter accepts an element if its value is of type integer.
 */
final class IntFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The value to be evaluated.
     * @return bool Returns true if the value is an integer; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_int($value);
    }
}
