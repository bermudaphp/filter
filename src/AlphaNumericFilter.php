<?php

namespace Bermuda\Filter;

/**
 * AlphaNumericFilter
 *
 * Accepts an element if its string value contains only alphanumeric characters.
 * Uses a regular expression to validate that the value consists exclusively of letters and digits.
 */
final class AlphaNumericFilter extends AbstractFilter implements FilterInterface
{
    /**
     * Determines whether the given element should be accepted.
     *
     * @param int|string $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool True if the element's string value is alphanumeric; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return preg_match('/^[a-zA-Z0-9]+$/', (string)$value) === 1;
    }
}
