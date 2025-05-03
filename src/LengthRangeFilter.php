<?php

namespace Bermuda\Filter;

/**
 * LengthRangeFilter
 *
 * Accepts an element if the length of its string value is between the specified minimum and maximum lengths.
 */
final class LengthRangeFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var int The minimum required length.
     */
    private int $minLength;

    /**
     * @var int The maximum allowed length.
     */
    private int $maxLength;

    /**
     * Constructor.
     *
     * @param int $minLength The minimum length.
     * @param int $maxLength The maximum length.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(int $minLength, int $maxLength, iterable $iterable = [])
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated minimum length.
     *
     * @param int $minLength The new minimum length.
     * @return self A new instance with the updated minimum.
     */
    public function withMinLength(int $minLength): self
    {
        $copy = clone $this;
        $copy->minLength = $minLength;
        return $copy;
    }

    /**
     * Returns a new instance with an updated maximum length.
     *
     * @param int $maxLength The new maximum length.
     * @return self A new instance with the updated maximum.
     */
    public function withMaxLength(int $maxLength): self
    {
        $copy = clone $this;
        $copy->maxLength = $maxLength;
        return $copy;
    }

    /**
     * Determines whether the element's length is within the set range.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element's value to evaluate.
     * @return bool True if the length is between min and max; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $length = strlen((string)$value);
        return ($length >= $this->minLength && $length <= $this->maxLength);
    }
}