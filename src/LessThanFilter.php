<?php

namespace Bermuda\Filter;

/**
 * LessThanFilter
 *
 * Accepts an element if its value (cast to a float) is less than a specified threshold.
 */
final class LessThanFilter extends AbstractFilter
{
    /**
     * @var float The threshold value.
     */
    private float $threshold;

    /**
     * Constructor.
     *
     * @param float $threshold The threshold the element’s numeric value must be below.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(float $threshold, iterable $iterable = [])
    {
        $this->threshold = $threshold;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated threshold.
     *
     * @param float $threshold The new threshold.
     * @return self A new LessThanFilter instance with the updated threshold.
     */
    public function withThreshold(float $threshold): self
    {
        $copy = clone $this;
        $copy->threshold = $threshold;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its value (cast to float) is less than the threshold.
     *
     * @param mixed $value The element to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if (float)$value < $threshold; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return (float)$value < $this->threshold;
    }
}