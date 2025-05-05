<?php

namespace Bermuda\Filter;

/**
 * OddNumberFilter
 *
 * Accepts an element if its numeric value represents an odd integer.
 * The filter returns false if the value is non-numeric or not an integer.
 */
final class OddNumberFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted only if its numeric value is an integer and is odd.
     *
     * @param mixed $value The element's value to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the value is an odd integer, false otherwise.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        // If the value is not numeric, casting yields 0; explicitly return false.
        if (!is_numeric($value)) {
            return false;
        }

        // Convert the value to a float and also to an integer.
        $floatValue = (float)$value;
        $intValue = (int)$floatValue;

        // If the float and integer forms differ, the value is not an integer.
        if ($floatValue !== $intValue) {
            return false;
        }

        // Accept the element only if the integer value is odd.
        return ($intValue % 2) !== 0;
    }
}