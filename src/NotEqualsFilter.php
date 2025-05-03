<?php

namespace Bermuda\Filter;

/**
 * NotEqualsFilter
 *
 * Accepts an element if its value does NOT equal the expected value.
 * The filter supports both strict (using !==) and loose (using !=) comparisons,
 * determined by the $strictComparison flag.
 */
final class NotEqualsFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var mixed The expected value to compare against.
     */
    private mixed $expectedValue;

    /**
     * @var bool Determines the comparison mode.
     *           If true, uses strict comparison (using !==). If false, uses loose comparison (using !=).
     */
    private bool $strictComparison;

    /**
     * Constructor.
     *
     * @param mixed $expectedValue The expected value to compare against.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $strictComparison Optional. Determines if strict comparison is used.
     *                               Defaults to true.
     */
    public function __construct(mixed $expectedValue, iterable $iterable = [], bool $strictComparison = true)
    {
        $this->expectedValue = $expectedValue;
        $this->strictComparison = $strictComparison;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated expected value.
     *
     * Optionally, you can change the comparison mode by providing a non-null value for $strictComparison.
     *
     * @param mixed $expectedValue The new expected value.
     * @param bool|null $strictComparison Optional. If provided, updates the comparison mode for the new instance.
     * @return self A new NotEqualsFilter instance with the updated expected value (and optionally the updated mode).
     */
    public function withExpectedValue(mixed $expectedValue, ?bool $strictComparison = null): self
    {
        $copy = clone $this;
        $copy->expectedValue = $expectedValue;
        if ($strictComparison !== null) {
            $copy->strictComparison = $strictComparison;
        }
        return $copy;
    }

    /**
     * Returns a new instance with an updated comparison mode.
     *
     * @param bool $strictComparison If true, the new instance will use strict comparison (using !==);
     *                               if false, it will use loose comparison (using !=).
     * @return self A new NotEqualsFilter instance with the specified comparison mode.
     */
    public function withStrictComparison(bool $strictComparison): self
    {
        $copy = clone $this;
        $copy->strictComparison = $strictComparison;
        return $copy;
    }

    /**
     * Gets the current comparison mode.
     *
     * @return bool True if using strict comparison; false otherwise.
     */
    public function isStrictComparison(): bool
    {
        return $this->strictComparison;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * If strictComparison is true, a strict inequality check (using !==) is performed.
     * Otherwise, a loose inequality check (using !=) is used.
     *
     * @param int|string $key The key associated with the element (unused in this filter).
     * @param mixed $value The element to be evaluated.
     * @return bool Returns true if the element's value does NOT equal the expected value based on the chosen mode.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        if ($this->strictComparison) {
            return $value !== $this->expectedValue;
        }
        return $value != $this->expectedValue;
    }
}
