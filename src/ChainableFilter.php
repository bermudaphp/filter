<?php

namespace Bermuda\Filter;

/**
 * ChainableFilter composes multiple filters and applies them sequentially to an iterable data source.
 *
 * An element is accepted only if every filter in the chain accepts it.
 * The class is immutable: methods that modify the filter chain return a new instance.
 *
 * This class extends AbstractFilter to inherit common iterator behavior and implements both
 * FilterInterface (for filtering) and FilterableInterface (for filter composition).
 */
class ChainableFilter extends AbstractFilter implements FilterableInterface
{
    /**
     * @var FilterInterface[] $filters Array of filter instances composing the chain.
     */
    protected iterable $filters;

    /**
     * Constructor.
     *
     * @param iterable<FilterInterface> $filters An iterable collection of filter instances.
     * @param iterable $iterable The data source that will be filtered.
     */
    public function __construct(
        iterable $filters,
        iterable $iterable = [],
    ) {
        foreach ($filters as $filter) $this->addFilter($filter);
        parent::__construct($iterable === [] ? $filters : $iterable);
    }

    /**
     * Returns a new ChainableFilter instance with an additional filter added.
     *
     * The $prepend parameter determines whether the new filter is added at the beginning (applied first)
     * or appended to the end of the chain (applied last).
     *
     * @param FilterInterface $filter The new filter to add.
     * @param bool $prepend If true, the new filter is added at the beginning of the chain.
     * @return ChainableFilter Returns a new FilterChain instance with the updated filter list.
     */
    public function withFilter(FilterInterface $filter, bool $prepend = false): ChainableFilter
    {
        $filters = $this->filters;

        if ($prepend) array_unshift($filters, $filter);
        else $filters[] = $filter;

        $copy = clone $this;
        $copy->filters = $filters;

        return $copy;
    }

    /**
     * Checks whether the given filter exists in the chain.
     *
     * @param FilterInterface $filter The filter to search for.
     * @return bool Returns true if the filter is found in the chain; otherwise, false.
     */
    public function hasFilter(FilterInterface $filter): bool
    {
        return in_array($filter, $this->filters, true);
    }

    /**
     * Adds a filter to the chain.
     *
     * This private helper method is used during initialization to add filters to the internal array.
     *
     * @param FilterInterface $filter The filter to add.
     */
    private function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    /**
     * Determines whether a given element should be accepted by the filter chain.
     *
     * The element is accepted only if every filter in the chain returns true for its key and value.
     *
     * @param mixed $value The element to be evaluated.
     * @param string|int|null $key The key associated with the value.
     * @return bool Returns true if all filters accept the element; false if any one rejects it.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        // Note: array_all() is assumed to be a helper function that returns true only if the provided callback
        // returns true for every element in the iterable.
        return array_all($this->filters, static fn($filter) => $filter->accept($value, $key));
    }

    /**
     * Returns a new ChainableFilter instance without the specified filter.
     *
     * This method removes the given filter (using strict inequality) from the current chain
     * and returns a new instance with the updated filter list.
     *
     * @param FilterInterface $filter The filter to be removed.
     * @return ChainableFilter Returns a new ChainableFilter instance without the specified filter.
     */
    public function withoutFilter(FilterInterface $filter): ChainableFilter
    {
        $copy = clone $this;
        $copy->filters = array_filter($this->filters, static fn($f) => $f !== $filter);

        return $copy;
    }
}
