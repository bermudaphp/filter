<?php

namespace Bermuda\Filter;

/**
 * AlphaNumericFilter
 *
 * Accepts an element if its string value contains only alphanumeric characters.
 * Uses a regular expression to validate that the value consists exclusively of letters and digits.
 */
final class AlphaNumericFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * @param mixed      $value The element to evaluate.
     * @param string|int|null $key   The key associated with the element.
     * @return bool True if the element's string value is alphanumeric; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return preg_match('/^[a-zA-Z0-9]+$/', (string)$value) === 1;
    }
}
