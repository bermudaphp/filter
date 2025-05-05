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
     * @param mixed      $value The value to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the value is an integer; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_int($value);
    }
}
