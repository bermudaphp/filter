<?php

namespace Bermuda\Filter;

/**
 * StringEqualsAnyFilter
 *
 * Accepts an element if its string value equals at least one of the allowed strings.
 * Supports both case-sensitive and case-insensitive comparisons.
 */
final class StringEqualsAnyFilter extends AbstractFilter
{
    /**
     * @var string[] An array of allowed strings.
     */
    private array $allowedStrings;

    /**
     * @var bool Determines if the comparison is case-sensitive.
     *           When true, comparison uses strict equality (===);
     *           when false, comparison uses a case-insensitive check.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param string[] $allowedStrings An array of allowed strings.
     * @param iterable $iterable       The data source to be filtered.
     * @param bool     $caseSensitive  Optional. True for a case-sensitive comparison,
     *                                 false for case-insensitive. Defaults to true.
     */
    public function __construct(array $allowedStrings, iterable $iterable = [], bool $caseSensitive = true)
    {
        $this->allowedStrings = $allowedStrings;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated allowed strings.
     *
     * @param string[] $allowedStrings The new array of allowed strings.
     * @return self A new StringEqualsAnyFilter instance with the updated allowed strings.
     */
    public function withAllowedStrings(array $allowedStrings): self
    {
        $copy = clone $this;
        $copy->allowedStrings = $allowedStrings;
        return $copy;
    }

    /**
     * Returns a new instance with updated case sensitivity setting.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new StringEqualsAnyFilter instance with the specified comparison mode.
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
     * The element is accepted if its string value equals any one element in the allowed list.
     * The comparison is done using either strict equality or a case-insensitive check, depending on the setting.
     *
     * @param mixed      $value The element to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if at least one allowed string equals the element's value; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return array_any($this->allowedStrings, static function ($allowed) use ($value) {
            if ($this->caseSensitive) {
                return $value === $allowed;
            }
            // For case-insensitive comparison, convert value to string and use strcasecmp.
            return strcasecmp((string)$value, $allowed) === 0;
        });
    }
}
