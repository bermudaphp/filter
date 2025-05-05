<?php

namespace Bermuda\Filter;

/**
 * BetweenFilter
 *
 * Accepts an element if its numeric value (cast to a float) falls between a specified minimum and maximum.
 * The comparison can be inclusive (default) or exclusive based on the $inclusive flag.
 */
final class BetweenFilter extends AbstractFilter
{
    /**
     * @var float The minimum threshold.
     */
    private float $min;

    /**
     * @var float The maximum threshold.
     */
    private float $max;

    /**
     * @var bool Whether the boundaries are inclusive (true) or exclusive (false).
     */
    private bool $inclusive;

    /**
     * Constructor.
     *
     * @param float $min The minimum value.
     * @param float $max The maximum value.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $inclusive Optional. True for inclusive boundaries; false for exclusive. Defaults to true.
     */
    public function __construct(float $min, float $max, iterable $iterable = [], bool $inclusive = true)
    {
        $this->min = $min;
        $this->max = $max;
        $this->inclusive = $inclusive;
        parent::__construct($iterable);
    }

    /**
     * Creates a new instance with an updated minimum value.
     *
     * @param float $min The new minimum.
     * @return self A new instance with the updated minimum.
     */
    public function withMin(float $min): self
    {
        $copy = clone $this;
        $copy->min = $min;
        return $copy;
    }

    /**
     * Creates a new instance with an updated maximum value.
     *
     * @param float $max The new maximum.
     * @return self A new instance with the updated maximum.
     */
    public function withMax(float $max): self
    {
        $copy = clone $this;
        $copy->max = $max;
        return $copy;
    }

    /**
     * Creates a new instance with an updated inclusiveness flag.
     *
     * @param bool $inclusive True for inclusive boundaries; false otherwise.
     * @return self A new instance with the updated flag.
     */
    public function withInclusive(bool $inclusive): self
    {
        $copy = clone $this;
        $copy->inclusive = $inclusive;
        return $copy;
    }

    /**
     * Determines whether the element's numeric value is between min and max.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element's value to evaluate.
     * @return bool True if the numeric value falls within the range; else, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $num = (float)$value;
        if ($this->inclusive) {
            return ($num >= $this->min && $num <= $this->max);
        }
        return ($num > $this->min && $num < $this->max);
    }
}