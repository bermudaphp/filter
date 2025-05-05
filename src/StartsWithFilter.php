<?php

namespace Bermuda\Filter;

/**
 * StartsWithFilter
 *
 * Accepts an element if its string value starts with the specified prefix.
 * Comparison can be either case sensitive or insensitive.
 */
final class StartsWithFilter extends AbstractFilter
{
    /**
     * @var string The prefix that the string must start with.
     */
    private string $prefix;

    /**
     * @var bool If true, the comparison is case sensitive; otherwise, it is case insensitive.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param string $prefix The prefix text.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $caseSensitive Optional. True for case-sensitive comparison, false for insensitive. Defaults to true.
     */
    public function __construct(string $prefix, iterable $iterable = [], bool $caseSensitive = true)
    {
        $this->prefix = $prefix;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated prefix.
     *
     * @param string $prefix The new prefix.
     * @return self A new StartsWithFilter instance.
     */
    public function withPrefix(string $prefix): self
    {
        $copy = clone $this;
        $copy->prefix = $prefix;
        return $copy;
    }

    /**
     * Returns a new instance with an updated case sensitivity.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new StartsWithFilter instance.
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
     * The element is accepted if its value (as a string) starts with the specified prefix.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the element's string value starts with the prefix; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        $stringValue = (string)$value;
        $len = strlen($this->prefix);
        if ($this->caseSensitive) {
            return substr($stringValue, 0, $len) === $this->prefix;
        }
        return strncasecmp($stringValue, $this->prefix, $len) === 0;
    }
}