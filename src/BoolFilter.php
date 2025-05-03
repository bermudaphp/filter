<?php

namespace Bermuda\Filter;

/**
 * BoolFilter
 *
 * This filter accepts an element if its value is a boolean.
 * Only the primary check is used: is_bool($value) is relied upon without extra validations.
 */
final class BoolFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the main check is performed: it returns the result of is_bool($value).
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if the value is a boolean; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_bool($value);
    }
}
