<?php

namespace Bermuda\Filter;

/**
 * GreaterThanEqualsFilter
 *
 * Accepts an element if its value (cast to a float) is greater than or equal to the specified threshold.
 */
final class GreaterThanEqualsFilter extends AbstractFilter
{
    /**
     * @var float The minimum threshold value.
     */
    private float $threshold;

    /**
     * Constructor.
     *
     * @param float $threshold The value the element's numeric value must be greater than or equal to.
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
     * @return self A new GreaterThanEqualsFilter instance with the updated threshold.
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
     * The element is accepted if its numeric value (cast to float) is greater than or equal to the threshold.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the element.
     * @return bool Returns true if (float)$value >= threshold; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return (float)$value >= $this->threshold;
    }
}