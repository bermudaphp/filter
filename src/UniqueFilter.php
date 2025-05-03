<?php

namespace Bermuda\Filter;

/**
 * UniqueFilter
 *
 * Accepts an element if it has not been seen before.
 * This filter maintains internal state and is therefore stateful.
 */
final class UniqueFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var array The set of values that have already been encountered.
     */
    private array $seen = [];

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted only if it has not been encountered previously.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to evaluate.
     * @return bool True if the value is unique (has not been seen before), false otherwise.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        // We use strict comparison to ensure exact uniqueness.
        if (in_array($value, $this->seen, true)) {
            return false;
        }
        $this->seen[] = $value;
        return true;
    }
}