<?php

namespace Bermuda\Filter;

/**
 * NumericFilter
 *
 * This filter accepts an element if its value is numeric.
 * It uses PHP's is_numeric() function to determine whether the value can be interpreted as a number.
 */
final class NumericFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * This method uses is_numeric() to check if the value is numeric.
     * This includes both actual number types (integers, floats) and strings which represent numbers.
     *
     * @param mixed      $value The value to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the value is numeric; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_numeric($value);
    }
}
