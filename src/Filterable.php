<?php

namespace Bermuda\Filter;

/**
 * Trait Filterable
 *
 * Provides functionality to manage a chain of filter objects and apply them to elements.
 * Classes using this trait gain the ability to add, check, remove, and apply filters (which implement FilterInterface)
 * through methods such as withFilter(), hasFilter(), accept(), and withoutFilter().
 */
trait Filterable
{
    /**
     * @var FilterInterface[] $filters Array of filter instances composing the chain.
     */
    protected array $filters = [];

    /**
     * Returns a new Filterable instance with an additional filter added.
     *
     * The $prepend parameter determines whether the new filter is added at the beginning (applied first)
     * or appended to the end of the chain (applied last).
     *
     * @param FilterInterface $filter The new filter to add.
     * @param bool $prepend If true, the new filter is added at the beginning of the chain.
     * @return FilterableInterface Returns a new instance implementing FilterableInterface with the updated filter list.
     */
    public function withFilter(FilterInterface $filter, bool $prepend = false): FilterableInterface
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
     * Determines whether a given element should be accepted by the filter chain.
     *
     * The element is accepted only if every filter in the chain returns true for its key and value.
     *
     * @param int|string $key The key associated with the value.
     * @param mixed $value The element to be evaluated.
     * @return bool Returns true if all filters accept the element; false if any one rejects it.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return array_all($this->filters, static fn($filter) => $filter->accept($key, $value));
    }

    /**
     * Returns a new Filterable instance without the specified filter.
     *
     * This method removes the given filter (using strict inequality) from the current chain
     * and returns a new instance with the updated filter list.
     *
     * @param FilterInterface $filter The filter to be removed.
     * @return FilterableInterface Returns a new instance implementing FilterableInterface without the specified filter.
     */
    public function withoutFilter(FilterInterface $filter): FilterableInterface
    {
        $copy = clone $this;
        $copy->filters = array_filter($this->filters, static fn($f) => $f !== $filter);

        return $copy;
    }
}