<?php

namespace Bermuda\Filter;

/**
 * KeyExcludeFilter
 *
 * Accepts an element if its key is not found in the excluded keys array.
 * This filter performs no additional type or auxiliary checks.
 */
final class KeyExcludeFilter extends AbstractFilter
{
    /**
     * @var array The list of keys to exclude.
     */
    private array $excludedKeys;

    /**
     * Constructor.
     *
     * @param array $excludedKeys An array of keys that should be excluded.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(array $excludedKeys, iterable $iterable = [])
    {
        $this->excludedKeys = $excludedKeys;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with updated excluded keys.
     *
     * @param array $excludedKeys The new array of keys to exclude.
     * @return self A new KeyExcludeFilter instance with updated keys.
     */
    public function withExcludedKeys(array $excludedKeys): self
    {
        $copy = clone $this;
        $copy->excludedKeys = $excludedKeys;
        return $copy;
    }

    /**
     * Evaluates whether the element should be accepted based solely on its key.
     *
     * @param mixed $value The element's value (unused).
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the key is not in the excluded keys array, false otherwise.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return !in_array($key, $this->excludedKeys, true);
    }
}