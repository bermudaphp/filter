<?php

namespace Bermuda\Filter;

/**
 * LessThanEqualsFilter
 *
 * Accepts an element if its value (cast to a float) is less than or equal to the specified threshold.
 */
final class LessThanEqualsFilter extends AbstractFilter
{
    /**
     * @var float The maximum threshold value.
     */
    private float $threshold;

    /**
     * Constructor.
     *
     * @param float $threshold The value the element's numeric value must be less than or equal to.
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
     * @return self A new LessThanEqualsFilter instance with the updated threshold.
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
     * The element is accepted if its numeric value (cast to float) is less than or equal to the threshold.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated.
     * @return bool Returns true if (float)$value <= threshold; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return (float)$value <= $this->threshold;
    }
}