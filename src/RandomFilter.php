<?php

namespace Bermuda\Filter;

/**
 * RandomFilter
 *
 * Accepts an element based on a random probability.
 * Each element is accepted if a randomly generated float between 0 and 1
 * is less than the set probability.
 */
final class RandomFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var float The acceptance probability (a value between 0 and 1).
     */
    private float $probability;

    /**
     * Constructor.
     *
     * @param float $probability The probability threshold for accepting an element (0 <= probability <= 1).
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(float $probability = 0.5, iterable $iterable = [])
    {
        $this->probability = $probability;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated probability.
     *
     * @param float $probability The new probability threshold.
     * @return self A new RandomFilter instance with the updated probability.
     */
    public function withProbability(float $probability): self
    {
        $copy = clone $this;
        $copy->probability = $probability;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * An element is accepted if a randomly generated float between 0 and 1 is less than the specified probability.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated.
     * @return bool True if accepted based on the probability, false otherwise.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        // Generate a random float between 0 and 1.
        $randomValue = mt_rand() / mt_getrandmax();
        return $randomValue < $this->probability;
    }
}