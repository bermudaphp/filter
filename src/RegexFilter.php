<?php

namespace Bermuda\Filter;

/**
 * RegexFilter
 *
 * This filter evaluates elements based on a regular expression pattern.
 * An element is accepted if its value matches the provided regex pattern.
 */
final class RegexFilter extends AbstractFilter
{
    /**
     * Constructor.
     *
     * Initializes the RegexFilter with a regex pattern and an optional iterable data source.
     *
     * @param string   $pattern   The regular expression pattern used for filtering.
     * @param iterable $iterable  An optional iterable data source to filter. Defaults to an empty array.
     */
    public function __construct(
        private readonly string $pattern,
        iterable $iterable = []
    ) {
        parent::__construct($iterable);
    }

    /**
     * Creates a new RegexFilter instance with the specified pattern.
     *
     * This method returns a new filter instance that uses the new pattern while retaining
     * the current iterable data source.
     *
     * @param string $pattern The new regular expression pattern to be used.
     * @return FilterInterface A new RegexFilter instance with the updated pattern.
     */
    public function withPattern(string $pattern): FilterInterface
    {
        return new self($pattern, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted based on the regex pattern.
     *
     * The method applies the regex pattern using preg_match and accepts the element if
     * the pattern matches (i.e., preg_match returns 1).
     *
     * @param int|string $key   The key associated with the element.
     * @param string $value The value to be tested against the regex pattern.
     * @return bool Returns true if the value matches the pattern; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return preg_match($this->pattern, (string) $value) === 1;
    }
}