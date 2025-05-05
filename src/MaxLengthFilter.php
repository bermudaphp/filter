<?php

namespace Bermuda\Filter;

/**
 * MaxLengthFilter
 *
 * Accepts an element if its string value's length is less than or equal to the specified maximum.
 */
final class MaxLengthFilter extends AbstractFilter
{
    /**
     * @var int The maximum allowed length.
     */
    private int $maxLength;

    /**
     * Constructor.
     *
     * @param int $maxLength The maximum length.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(int $maxLength, iterable $iterable = [])
    {
        $this->maxLength = $maxLength;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated maximum length.
     *
     * @param int $maxLength The new maximum length.
     * @return self A new MaxLengthFilter instance.
     */
    public function withMaxLength(int $maxLength): self
    {
        $copy = clone $this;
        $copy->maxLength = $maxLength;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its string value's length is less than or equal to the specified maximum.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to evaluate.
     * @return bool True if the length is within the limit; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return strlen((string)$value) <= $this->maxLength;
    }
}