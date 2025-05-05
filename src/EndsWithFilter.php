<?php

namespace Bermuda\Filter;

/**
 * EndsWithFilter
 *
 * Accepts an element if its string value ends with the specified suffix.
 * Supports both case-sensitive and case-insensitive comparisons.
 */
final class EndsWithFilter extends AbstractFilter
{
    /**
     * @var string The suffix that the string must end with.
     */
    private string $suffix;

    /**
     * @var bool If true, the comparison is case sensitive; otherwise, it is case insensitive.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param string $suffix The suffix text.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $caseSensitive Optional. True for case-sensitive comparison, false for insensitive. Defaults to true.
     */
    public function __construct(string $suffix, iterable $iterable = [], bool $caseSensitive = true)
    {
        $this->suffix = $suffix;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated suffix.
     *
     * @param string $suffix The new suffix.
     * @return self A new EndsWithFilter instance.
     */
    public function withSuffix(string $suffix): self
    {
        $copy = clone $this;
        $copy->suffix = $suffix;
        return $copy;
    }

    /**
     * Returns a new instance with an updated case sensitivity.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new EndsWithFilter instance.
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
     * The element is accepted if its string value ends with the specified suffix.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the element's string value ends with the suffix; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        $stringValue = (string)$value;
        $suffixLen = strlen($this->suffix);
        if ($suffixLen === 0) {
            return true;
        }
        if ($this->caseSensitive) {
            return substr($stringValue, -$suffixLen) === $this->suffix;
        }
        return strcasecmp(substr($stringValue, -$suffixLen), $this->suffix) === 0;
    }
}