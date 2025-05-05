<?php

namespace Bermuda\Filter;

/**
 * NotFilter
 *
 * Accepts an element if the provided filter does NOT accept it.
 * Only the primary check is used: the result of the inner filter's accept() is inverted.
 */
final class NotFilter extends AbstractFilter
{
    /**
     * @var FilterInterface The filter whose result will be inverted.
     */
    private FilterInterface $filter;

    /**
     * Constructor.
     *
     * @param FilterInterface $filter The filter to invert.
     * @param iterable $iterable The data source to be filtered; defaults to an empty array.
     */
    public function __construct(FilterInterface $filter, iterable $iterable = [])
    {
        $this->filter = $filter;
        parent::__construct($iterable);
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * Returns true if the inner filter rejects the element.
     *
     * @param mixed $value The element to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the inner filter returns false; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return !$this->filter->accept($value, $key);
    }

    /**
     * Returns a new instance with the specified filter.
     *
     * @param FilterInterface $filter The new filter to invert.
     * @return NotFilter A new instance with the updated inner filter.
     */
    public function withFilter(FilterInterface $filter): self
    {
        $copy = clone $this;
        $copy->filter = $filter;
        return $copy;
    }
}
