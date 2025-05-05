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
     * @param mixed      $value The element to evaluate.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the value is a boolean; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_bool($value);
    }
}
