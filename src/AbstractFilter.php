<?php

namespace Bermuda\Filter;

/**
 * Abstract base class that implements common functionality for filtering an iterable collection.
 *
 * This class implements FilterInterface and provides a generator-based iterator via getIterator().
 * It uses an internal iterable as the data source and applies the filtering logic defined in the
 * abstract accept() method to yield only the elements that should be included.
 *
 * Subclasses must override the accept() method to provide their specific filtering criteria.
 */
abstract class AbstractFilter implements FilterInterface
{
    /**
     * Constructor.
     *
     * Optionally accepts an iterable data source to initialize the filter.
     *
     * @param iterable $iterable The initial data source to filter. Defaults to an empty array.
     */
    public function __construct(
        protected iterable $iterable = []
    ) {
    }

    /**
     * Returns an iterator that yields each element from the iterable that passes the filter criteria.
     *
     * Iterates over the provided iterable and, for each key-value pair, calls the accept() method.
     * If accept() returns true, the key-value pair will be yielded; otherwise, it will be skipped.
     *
     * @return \Generator A generator yielding the filtered key-value pairs.
     */
    public function getIterator(): \Generator
    {
        foreach ($this->iterable as $key => $value) {
            if ($value instanceof FilterInterface) {
                yield from $value->getIterator();
            } else if ($this->accept($value, $key)) {
                yield $key => $value;
            }
        }
    }

    /**
     * Returns a new filter instance with a different iterable data source.
     *
     * To maintain immutability, this method clones the current instance, assigns the new iterable
     * to the clone, and returns it so that the original instance remains unmodified.
     *
     * @param iterable $iterable The new data source to filter.
     * @return AbstractFilter A new filter instance with the provided iterable.
     */
    public function withIterable(iterable $iterable): AbstractFilter
    {
        $copy = clone $this;
        $copy->iterable = $iterable;

        return $copy;
    }

    /**
     * Converts the filtered results to an array.
     *
     * This method uses the getIterator() generator to build an array of all key-value pairs
     * that satisfy the filter criteria.
     *
     * @param bool $preserveKeys If true, the original keys are preserved; otherwise, the array is re-indexed.
     * @return array An array representation of the filtered elements.
     */
    public function toArray(bool $preserveKeys = false): array
    {
        return iterator_to_array($this->getIterator(), $preserveKeys);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Subclasses must implement this method to define the specific filtering criteria.
     * It receives both the key and value of the current element, and returns true if the
     * element should be included in the filtered results, false otherwise.
     *
     * @param mixed      $value The element to be evaluated.
     * @param string|int|null $key   The key associated with the current element.
     * @return bool Returns true if the element satisfies the filter criteria; false otherwise.
     */
    abstract public function accept(mixed $value, string|int|null $key = null): bool;
}