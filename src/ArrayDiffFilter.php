<?php

namespace Bermuda\Filter;

/**
 * ArrayDiffFilter
 *
 * Accepts an element if the element's array does NOT contain any of the values
 * specified in the exclusion array. It computes array_diff($value, $excludedValues) and
 * compares the result to the original value.
 */
final class ArrayDiffFilter extends AbstractFilter
{
    /**
     * @var array The array of excluded values.
     */
    private array $excludedValues;

    /**
     * Constructor.
     *
     * @param array $excludedValues The values to exclude.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(array $excludedValues, iterable $iterable = [])
    {
        $this->excludedValues = $excludedValues;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated excluded values.
     *
     * @param array $excludedValues The new exclusion array.
     * @return self A new ArrayDiffFilter instance.
     */
    public function withExcludedValues(array $excludedValues): self
    {
        $copy = clone $this;
        $copy->excludedValues = $excludedValues;
        return $copy;
    }

    /**
     * Determines whether the element should be accepted.
     *
     * Accepts the element if array_diff($value, $excludedValues) equals the original $value,
     * meaning none of the excluded values are present.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element's array value.
     * @return bool True if no excluded values are found in $value; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return array_diff($value, $this->excludedValues) == $value;
    }
}