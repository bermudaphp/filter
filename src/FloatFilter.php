<?php

namespace Bermuda\Filter;

/**
 * FloatFilter
 *
 * This filter accepts an element if its value is of type float.
 */
final class FloatFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The value to be evaluated.
     * @return bool Returns true if the value is a float; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_float($value);
    }
}
