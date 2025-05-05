<?php

namespace Bermuda\Filter;

/**
 * InArrayFilter
 *
 * Accepts an element if its value is present in the provided array of allowed values.
 * Supports both strict and loose comparisons.
 */
final class InArrayFilter extends AbstractFilter
{
    /**
     * @var array The allowed values.
     */
    private array $allowedValues;

    /**
     * @var bool If true, uses strict comparison; otherwise, loose comparison.
     */
    private bool $strict;

    /**
     * Constructor.
     *
     * @param array    $allowedValues The array of allowed values.
     * @param iterable $iterable      The data source to be filtered.
     * @param bool     $strict        Optional. Defaults to true for strict (===) comparison.
     */
    public function __construct(array $allowedValues, iterable $iterable = [], bool $strict = true)
    {
        $this->allowedValues = $allowedValues;
        $this->strict = $strict;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated allowed values.
     *
     * @param array $allowedValues The new allowed values.
     * @return self A new InArrayFilter instance with the updated allowed values.
     */
    public function withAllowedValues(array $allowedValues): self
    {
        $copy = clone $this;
        $copy->allowedValues = $allowedValues;
        return $copy;
    }

    /**
     * Returns a new instance with an updated comparison mode.
     *
     * @param bool $strict True for strict comparison, false for loose.
     * @return self A new InArrayFilter instance with the updated mode.
     */
    public function withStrict(bool $strict): self
    {
        $copy = clone $this;
        $copy->strict = $strict;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its value is in the allowed values array.
     *
     * @param mixed      $value The element to evaluate.
     * @param string|int|null $key   The key associated with the element.
     * @return bool True if the value is found in the allowed values; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return in_array($value, $this->allowedValues, $this->strict);
    }
}
