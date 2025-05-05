<?php

namespace Bermuda\Filter;

/**
 * ArrayIntersectFilter
 *
 * Accepts an element if the intersection of the element's array and the provided allowed values is non-empty.
 * It uses array_intersect() to calculate the common values between the two arrays.
 */
final class ArrayIntersectFilter extends AbstractFilter
{
    /**
     * @var array The array of allowed values.
     */
    private array $allowedValues;

    /**
     * Constructor.
     *
     * @param array $allowedValues An array of values to intersect against.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(array $allowedValues, iterable $iterable = [])
    {
        $this->allowedValues = $allowedValues;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated allowed values.
     *
     * @param array $allowedValues The new array of allowed values.
     * @return self A new ArrayIntersectFilter instance.
     */
    public function withAllowedValues(array $allowedValues): self
    {
        $copy = clone $this;
        $copy->allowedValues = $allowedValues;
        return $copy;
    }

    /**
     * Determines whether the element should be accepted.
     *
     * Accepts the element if array_intersect($value, $allowedValues) is not empty.
     *
     * @param mixed $value The element's array value.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the intersection is not empty; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return count(array_intersect($value, $this->allowedValues)) > 0;
    }
}