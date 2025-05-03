<?php

namespace Bermuda\Filter;

/**
 * StringEqualsFilter
 *
 * Accepts an element if its string value exactly equals the expected string.
 * Supports both case-sensitive and case-insensitive comparisons.
 */
final class StringEqualsFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var string The expected string to compare against.
     */
    private string $expected;

    /**
     * @var bool Determines if the comparison is case-sensitive.
     *           When true, comparison is performed using strict equality (===).
     *           When false, comparison is performed in a case-insensitive manner.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param string   $expected      The expected string.
     * @param iterable $iterable      The data source to be filtered.
     * @param bool     $caseSensitive Optional. True for a case-sensitive comparison,
     *                                false for case-insensitive. Defaults to true.
     */
    public function __construct(string $expected, iterable $iterable = [], bool $caseSensitive = true)
    {
        $this->expected = $expected;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with the updated expected string.
     *
     * @param string $expected The new expected string.
     * @return self A new StringEqualsFilter instance with the updated expected value.
     */
    public function withExpected(string $expected): self
    {
        $copy = clone $this;
        $copy->expected = $expected;
        return $copy;
    }

    /**
     * Returns a new instance with the updated case sensitivity setting.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new StringEqualsFilter instance with the updated comparison mode.
     */
    public function withCaseSensitive(bool $caseSensitive): self
    {
        $copy = clone $this;
        $copy->caseSensitive = $caseSensitive;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its string value equals the expected string.
     * If case sensitivity is disabled, the check is performed using a case-insensitive comparison.
     *
     * @param int|string $key   The key associated with the element.
     * @param mixed      $value The element to be evaluated.
     * @return bool Returns true if the element equals the expected string; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        if ($this->caseSensitive) {
            return $value === $this->expected;
        }
        // Use strcasecmp for case-insensitive comparison (after casting value to string)
        return strcasecmp((string)$value, $this->expected) === 0;
    }
}
