<?php

namespace Bermuda\Filter;

/**
 * OnlyFilter
 *
 * Accepts an element if its value is present in the allowed values array.
 * No additional validation is performed.
 */
final class OnlyFilter extends AbstractFilter
{
    /**
     * @var array The list of allowed values.
     */
    private array $allowedValues;

    /**
     * Constructor.
     *
     * @param array $allowedValues An array of allowed values.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(array $allowedValues, iterable $iterable = [])
    {
        $this->allowedValues = $allowedValues;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated allowed values array.
     *
     * @param array $allowedValues The new array of allowed values.
     * @return self A new OnlyFilter instance with updated values.
     */
    public function withAllowedValues(array $allowedValues): self
    {
        $copy = clone $this;
        $copy->allowedValues = $allowedValues;
        return $copy;
    }

    /**
     * Evaluates whether the element should be accepted based solely on its value.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the element (unused).
     * @return bool True if the value is in the allowed values array, false otherwise.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return in_array($value, $this->allowedValues, true);
    }
}