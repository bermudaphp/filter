<?php

namespace Bermuda\Filter;

/**
 * KeyIntersectFilter
 *
 * Accepts an element if its key is present in the allowed keys array.
 *
 * Note: This filter compares only the key (passed as the first parameter to accept())
 * against the provided allowed keys. No additional type or auxiliary checks are performed.
 */
final class KeyIntersectFilter extends AbstractFilter
{
    /**
     * @var array List of allowed keys.
     */
    private array $allowedKeys;

    /**
     * Constructor.
     *
     * @param array $allowedKeys An array of allowed keys.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(array $allowedKeys, iterable $iterable = [])
    {
        $this->allowedKeys = $allowedKeys;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated allowed keys.
     *
     * @param array $allowedKeys The new array of allowed keys.
     * @return self A new KeyIntersectFilter instance with the updated allowed keys.
     */
    public function withAllowedKeys(array $allowedKeys): self
    {
        $copy = clone $this;
        $copy->allowedKeys = $allowedKeys;
        return $copy;
    }

    /**
     * Determines whether the element should be accepted.
     *
     * Accepts the element if its key is in the allowed keys array.
     *
     * @param mixed $value The element's value (unused).
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the key is allowed; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return in_array($key, $this->allowedKeys, true);
    }
}