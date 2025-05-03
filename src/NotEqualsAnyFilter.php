<?php

namespace Bermuda\Filter;

/**
 * NotEqualsAnyFilter
 *
 * Accepts an element if its value does NOT equal any of the expected values.
 * The comparison mode is determined by the $strictComparison flag:
 * - When true, strict comparison (!==) is used.
 * - When false, loose comparison (!=) is used.
 */
final class NotEqualsAnyFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var array The list of expected values.
     */
    private array $expectedValues;

    /**
     * @var bool Determines the comparison mode.
     *           If true, strict comparison is used; otherwise, loose comparison is used.
     */
    private bool $strictComparison;

    /**
     * Constructor.
     *
     * @param array $expectedValues An array of expected values.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $strictComparison Optional. Use strict (!==) if true, loose (!=) if false. Defaults to true.
     */
    public function __construct(array $expectedValues, iterable $iterable = [], bool $strictComparison = true)
    {
        $this->expectedValues = $expectedValues;
        $this->strictComparison = $strictComparison;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated expected values.
     *
     * @param array $expectedValues The new expected values.
     * @return self A new NotEqualsAnyFilter instance with the updated expected values.
     */
    public function withExpectedValues(array $expectedValues): self
    {
        $copy = clone $this;
        $copy->expectedValues = $expectedValues;
        return $copy;
    }

    /**
     * Returns a new instance with an updated comparison mode.
     *
     * @param bool $strictComparison If true, the new instance will use strict comparison; otherwise, loose.
     * @return self A new NotEqualsAnyFilter instance with the specified comparison mode.
     */
    public function withStrictComparison(bool $strictComparison): self
    {
        $copy = clone $this;
        $copy->strictComparison = $strictComparison;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its value does NOT equal any of the expected values.
     * The check uses strict (!==) or loose (!=) comparison based on the $strictComparison flag.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated.
     * @return bool Returns true if none of the expected values equal the element's value.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return !array_any($this->expectedValues, static function ($expected) use ($value) {
            return $this->strictComparison
                ? $value === $expected
                : $value == $expected;
        });
    }
}
