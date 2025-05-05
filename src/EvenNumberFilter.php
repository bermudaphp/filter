<?php

namespace Bermuda\Filter;

/**
 * EvenNumberFilter
 *
 * This filter accepts an element if its value is an integer and is even.
 */
final class EvenNumberFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * This method checks if the provided value is an integer and if it is even.
     *
     * @param mixed      $value The value to be checked.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the value is an even integer; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return ($value % 2 === 0);
    }
}
