<?php

namespace Bermuda\Filter;

/**
 * KeyOnlyFilter
 *
 * Accepts an element if its key is present in the allowed keys array.
 * No additional checks or type validations are performed.
 */
final class KeyOnlyFilter extends AbstractFilter
{
    /**
     * @var array The list of allowed keys.
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
     * Returns a new instance with an updated allowed keys array.
     *
     * @param array $allowedKeys The new array of allowed keys.
     * @return self A new KeyOnlyFilter instance with updated keys.
     */
    public function withAllowedKeys(array $allowedKeys): self
    {
        $copy = clone $this;
        $copy->allowedKeys = $allowedKeys;
        return $copy;
    }

    /**
     * Evaluates whether the element should be accepted based solely on its key.
     *
     * @param mixed $value The element's value (unused).
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the key is in the allowed keys array, false otherwise.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return in_array($key, $this->allowedKeys, true);
    }
}