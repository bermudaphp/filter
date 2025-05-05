<?php

namespace Bermuda\Filter;

/**
 * MinLengthFilter
 *
 * Accepts an element if its string value has a length greater than or equal to the specified minimum.
 */
final class MinLengthFilter extends AbstractFilter
{
    /**
     * @var int The minimum required length.
     */
    private int $minLength;

    /**
     * Constructor.
     *
     * @param int $minLength The minimum length.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(int $minLength, iterable $iterable = [])
    {
        $this->minLength = $minLength;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated minimum length.
     *
     * @param int $minLength The new minimum length.
     * @return self A new MinLengthFilter instance.
     */
    public function withMinLength(int $minLength): self
    {
        $copy = clone $this;
        $copy->minLength = $minLength;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its string value's length is at least the specified minimum.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to evaluate.
     * @return bool True if the length is sufficient; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return strlen((string)$value) >= $this->minLength;
    }
}