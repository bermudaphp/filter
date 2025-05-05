<?php

namespace Bermuda\Filter;

/**
 * UniqueFilter
 *
 * Accepts an element if it has not been seen before.
 * This filter maintains internal state and is therefore stateful.
 */
final class UniqueFilter extends AbstractFilter
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
    /**
     * __clone
     *
     * When a UniqueFilter instance is cloned, reset the internal $seen state.
     * This ensures that a clone starts with an empty history.
     */
    public function __clone(): void
    {
        $this->seen = [];
    }

    /**
     * Returns an iterator that yields each element from the iterable that passes the filter criteria.
     *
     * Before iterating, reset the internal state ($seen) to ensure that the filtering is applied
     * from a clean starting point. Then delegate to the parent implementation, which iterates
     * over the data source and uses accept() for each element.
     *
     * @return \Generator A generator yielding the filtered key-value pairs.
     */
    public function getIterator(): \Generator
    {
        $this->seen = [];
        return parent::getIterator();
    }
}