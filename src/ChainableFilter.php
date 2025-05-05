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
    use Filterable;
    
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
}
