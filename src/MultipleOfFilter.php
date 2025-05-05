<?php

namespace Bermuda\Filter;

/**
 * MultipleOfFilter
 *
 * Accepts an element if its numeric value (cast to float) is a multiple of a specified divisor.
 */
final class MultipleOfFilter extends AbstractFilter
{
    /**
     * @var float The divisor used to test divisibility.
     */
    private float $divisor;

    /**
     * Constructor.
     *
     * @param float $divisor The divisor the element's value must be a multiple of.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(float $divisor, iterable $iterable = [])
    {
        $this->divisor = $divisor;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated divisor.
     *
     * @param float $divisor The new divisor.
     * @return self A new MultipleOfFilter instance with the updated divisor.
     */
    public function withDivisor(float $divisor): self
    {
        $copy = clone $this;
        $copy->divisor = $divisor;
        return $copy;
    }

    /**
     * Determines whether the element's numeric value is divisible by the divisor.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if $value (cast to float) is a multiple of the divisor; false if not or divisor is 0.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        if ($this->divisor == 0.0) {
            return false;
        }
        $num = (float)$value;
        return fmod($num, $this->divisor) === 0.0;
    }
}