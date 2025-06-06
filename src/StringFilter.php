<?php

namespace Bermuda\Filter;

/**
 * StringFilter
 *
 * This filter accepts an element if its value is either a string or an object
 * that implements the \Stringable interface (i.e., it can be cast to a string).
 */
final class StringFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * This method checks if the value is a string using is_string(), or if it implements
     * the \Stringable interface, which means the object can be converted into a string.
     *
     * @param mixed      $value The value to be assessed.
     * @param string|int|null $key   The key associated with the element.
     *
     * @return bool Returns true if the value is a string or an instance of \Stringable; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_string($value) || $value instanceof \Stringable;
    }
}