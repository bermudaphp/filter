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
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The value to be evaluated.
     * @return bool Returns true if the value is numeric; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_numeric($value);
    }
}
