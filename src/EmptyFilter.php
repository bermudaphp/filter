<?php

namespace Bermuda\Filter;

/**
 * EmptyFilter
 *
 * Accepts an element if its value is empty.
 * This filter uses the primary check via PHP's empty() function.
 */
final class EmptyFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if PHP's empty() function returns true for the value.
     *
     * @param mixed      $value The element to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if the element is empty; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return empty($value);
    }
}
