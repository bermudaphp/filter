<?php

namespace Bermuda\Filter;

/**
 * NotEmptyFilter
 *
 * Accepts an element if its value is not empty.
 * This filter uses only the primary check by negating PHP's empty() function.
 */
final class NotEmptyFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if PHP's empty() function returns false for the value.
     *
     * @param mixed      $value The element to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the element is not empty; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return !empty($value);
    }
}
