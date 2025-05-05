<?php

namespace Bermuda\Filter;

/**
 * ExcludeFilter
 *
 * Accepts an element if its value is not present in the excluded values array.
 * No additional checks or validations are performed.
 */
final class ExcludeFilter extends AbstractFilter
{
    /**
     * @var array The list of values to exclude.
     */
    private array $excludedValues;

    /**
     * Constructor.
     *
     * @param array $excludedValues An array of values that should be excluded.
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
     * @param array $excludedValues The new array of excluded values.
     * @return self A new ExcludeFilter instance with updated values.
     */
    public function withExcludedValues(array $excludedValues): self
    {
        $copy = clone $this;
        $copy->excludedValues = $excludedValues;
        return $copy;
    }

    /**
     * Evaluates whether the element should be accepted based solely on its value.
     *
     * @param int|string $key The key associated with the element (unused).
     * @param mixed $value The element to evaluate.
     * @return bool True if the value is not in the excluded values array; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return !in_array($value, $this->excludedValues, true);
    }
}