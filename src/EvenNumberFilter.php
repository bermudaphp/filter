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
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The value to be checked.
     * @return bool Returns true if the value is an even integer; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return ($value % 2 === 0);
    }
}
