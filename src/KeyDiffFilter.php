<?php

namespace Bermuda\Filter;

/**
 * KeyDiffFilter
 *
 * Accepts an element if its key is not included in the excluded keys array.
 *
 * Note: This filter compares solely the element's key against the provided disallowed keys.
 */
final class KeyDiffFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var array List of disallowed keys.
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
     * Returns a new instance with updated disallowed keys.
     *
     * @param array $excludedKeys The new array of keys to exclude.
     * @return self A new KeyDiffFilter instance with the updated excluded keys.
     */
    public function withExcludedKeys(array $excludedKeys): self
    {
        $copy = clone $this;
        $copy->excludedKeys = $excludedKeys;
        return $copy;
    }

    /**
     * Determines whether the element should be accepted.
     *
     * Accepts the element if its key is NOT present in the excluded keys array.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element's value (unused).
     * @return bool True if the key is not excluded; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return !in_array($key, $this->excludedKeys, true);
    }
}