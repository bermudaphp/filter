<?php

namespace Bermuda\Filter;

/**
 * ContainsFilter
 *
 * Accepts an element if its string value contains the specified substring.
 * Comparison can be case sensitive or insensitive.
 */
final class ContainsFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var string The substring to search for within the value.
     */
    private string $substring;

    /**
     * @var bool If true, the comparison is case sensitive; otherwise, it is case insensitive.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param string $substring The substring to look for.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $caseSensitive Optional. True for case-sensitive, false for case-insensitive. Defaults to true.
     */
    public function __construct(string $substring, iterable $iterable = [], bool $caseSensitive = true)
    {
        $this->substring = $substring;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated substring.
     *
     * @param string $substring The new substring.
     * @return self A new ContainsFilter instance.
     */
    public function withSubstring(string $substring): self
    {
        $copy = clone $this;
        $copy->substring = $substring;
        return $copy;
    }

    /**
     * Returns a new instance with updated case sensitivity.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new ContainsFilter instance.
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
     * The element is accepted if its string value contains the specified substring.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated.
     * @return bool True if the substring is found; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $stringValue = (string)$value;
        if ($this->caseSensitive) {
            return strpos($stringValue, $this->substring) !== false;
        }
        return stripos($stringValue, $this->substring) !== false;
    }
}