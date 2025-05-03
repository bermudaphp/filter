<?php

namespace Bermuda\Filter;

/**
 * EmptyFilter
 *
 * Accepts an element if its value is empty.
 * This filter uses the primary check via PHP's empty() function.
 */
final class EmptyFilter extends AbstractFilter implements FilterInterface
{
    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if PHP's empty() function returns true for the value.
     *
     * @param int|string $key   The key associated with the element.
     * @param mixed      $value The element to be evaluated.
     * @return bool Returns true if the element is empty; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return empty($value);
    }
}
