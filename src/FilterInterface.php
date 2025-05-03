<?php

namespace Bermuda\Filter;

use Bermuda\Stdlib\Arrayable;

/**
 * Interface FilterInterface
 *
 * This interface represents a filter that works on an iterable collection.
 * It extends \IteratorAggregate so that implementations can be iterated directly,
 * providing direct access to the filtered results. Implementations must supply a way
 * to set the data source via withIterable() and to evaluate whether an element should
 * be included via the accept() method.
 */
interface FilterInterface extends \IteratorAggregate, Arrayable
{
    /**
     * Sets the iterable data source to be filtered.
     *
     * This method accepts any iterable (such as an array or an instance
     * of Traversable) and assigns it as the data source for filtering. It returns
     * the filter instance, allowing for fluent method chaining.
     *
     * @param iterable $iterable The data source to filter.
     * @return FilterInterface Returns the filter instance.
     */
    public function withIterable(iterable $iterable): FilterInterface;

    /**
     * Evaluates whether a given element meets the filter criteria.
     *
     * The accept() method serves as the filter’s predicate. It should return true
     * if the element (identified by its key and value) meets the criteria and should
     * be included in the filtered results; otherwise, it should return false.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to check.
     * @return bool Returns true if the element satisfies the filter's criteria, false otherwise.
     */
    public function accept(string|int $key, mixed $value): bool;

    /**
     * Converts the filtered result set to an array.
     *
     * As inherited from the Arrayable interface, this method should return an array
     * representation of the filtered data.
     *
     * @param bool $preserveKeys Determines whether to preserve the original keys.
     * @return array Returns an array of filtered items.
     */
    public function toArray(bool $preserveKeys = false): array;
}
