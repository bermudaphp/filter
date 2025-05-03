<?php

namespace Bermuda\Filter;

/**
 * ObjectFilter
 *
 * This filter accepts an element if its value is an object.
 * Only the main check is performed using is_object(<value>).
 */
final class ObjectFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the primary check is used: it returns the result of is_object(<value>).
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if the value is an object; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_object($value);
    }
}
