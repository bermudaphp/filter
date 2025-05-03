<?php

namespace Bermuda\Filter;

/**
 * RangeFilter
 *
 * Accepts an element if its numeric value (converted to float) falls between a minimum and maximum value, inclusively.
 * Only the primary comparison check is performed.
 */
final class RangeFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var float The minimum allowed value.
     */
    private float $min;

    /**
     * @var float The maximum allowed value.
     */
    private float $max;

    /**
     * Constructor.
     *
     * @param float $min The minimum allowed numeric value.
     * @param float $max The maximum allowed numeric value.
     * @param iterable $iterable The data source to be filtered; defaults to an empty array.
     */
    public function __construct(float $min, float $max, iterable $iterable = [])
    {
        $this->min = $min;
        $this->max = $max;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with the updated minimum value.
     *
     * @param float $min The new minimum value.
     * @return self A new RangeFilter instance with the updated minimum.
     */
    public function withMin(float $min): self
    {
        $copy = clone $this;
        $copy->min = $min;
        return $copy;
    }

    /**
     * Returns a new instance with the updated maximum value.
     *
     * @param float $max The new maximum value.
     * @return self A new RangeFilter instance with the updated maximum.
     */
    public function withMax(float $max): self
    {
        $copy = clone $this;
        $copy->max = $max;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if its numeric value (as a float) is between the minimum and maximum, inclusive.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to evaluate.
     * @return bool True if the value is within range; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $number = (float)$value;
        return $number >= $this->min && $number <= $this->max;
    }
}
