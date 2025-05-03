<?php

namespace Bermuda\Filter;

/**
 * Interface FilterableInterface
 *
 * This interface defines the contract for an object that can have filters added or removed.
 * Implementing classes should treat filter modifications immutably, returning a new instance
 * with the updated filter set instead of modifying the current instance in place.
 *
 */
interface FilterableInterface
{
    /**
     * Returns a new instance with the specified filter added to the filter chain.
     *
     * The $prepend parameter indicates where the new filter should be placed:
     * - If true, the filter is added to the beginning (i.e., it is applied first).
     * - If false, the filter is appended to the end (i.e., it is applied last).
     *
     * This allows for building complex filter chains by composing individual filters.
     *
     * @param FilterInterface $filter  The filter to be added.
     * @param bool            $prepend Whether to add the new filter at the beginning.
     *
     * @return FilterableInterface Returns a new instance with the added filter.
     */
    public function withFilter(FilterInterface $filter, bool $prepend = false): FilterableInterface;

    /**
     * Returns a new instance with the specified filter removed from the filter chain.
     *
     * This method enables modifying the filter chain by excluding a filter that was previously applied.
     * The method should search for the filter (using strict equality) in the current chain and, if found,
     * return a new instance without that filter.
     *
     * @param FilterInterface $filter The filter to be removed.
     *
     * @return FilterableInterface Returns a new instance without the specified filter.
     */
    public function withoutFilter(FilterInterface $filter): FilterableInterface;
}