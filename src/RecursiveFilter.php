<?php

namespace Bermuda\Filter;

/**
 * RecursiveFilter applies a given filter recursively to an iterable data source.
 *
 * For each element in the iterable data source:
 * - If the element itself is iterable, the filter is applied recursively to that element.
 * - Otherwise, the element is passed to the provided filter.
 *
 * If $yieldNestedAsArray is true, the filtered nested iterable is converted to an array before yielding.
 */
final class RecursiveFilter extends AbstractFilter
{
    /**
     * @var bool Indicates whether nested iterables should be yielded as arrays.
     */
    private(set) bool $yieldNestedAsArray {
        get {
            return $this->yieldNestedAsArray;
        }
    }

    /**
     * Constructor.
     *
     * @param FilterInterface $filter The filter to apply recursively.
     * @param iterable $iterable The data source to be filtered. Defaults to an empty array.
     * @param bool $yieldNestedAsArray If true, nested iterables are yielded as arrays.
     */
    public function __construct(
        private FilterInterface $filter,
        iterable $iterable = [],
        bool $yieldNestedAsArray = false
    ) {
        $this->yieldNestedAsArray = $yieldNestedAsArray;
        // If no iterable is provided, use the filter itself as the iterable.
        parent::__construct($iterable === [] ? $this->filter : $iterable);
    }

    /**
     * Returns a new instance with the provided filter replacing the current one.
     *
     * This method supports immutability by cloning the current instance and applying the new filter.
     *
     * @param FilterInterface $filter The new filter to use.
     * @return FilterInterface A new RecursiveFilter instance with the updated filter.
     */
    public function withFilter(FilterInterface $filter): FilterInterface
    {
        $copy = clone $this;
        $copy->filter = $filter;
        return $copy;
    }

    /**
     * Returns a new instance with the updated yieldNestedAsArray flag.
     *
     * This method supports immutability by returning a clone with the updated setting.
     *
     * @param bool $yieldNestedAsArray If true, nested iterables will be yielded as arrays.
     * @return self A new RecursiveFilter instance with the specified setting.
     */
    public function withYieldNestedAsArray(bool $yieldNestedAsArray): self
    {
        $copy = clone $this;
        $copy->yieldNestedAsArray = $yieldNestedAsArray;
        return $copy;
    }

    /**
     * Retrieves a generator that yields filtered elements from the iterable data source.
     *
     * For each element:
     * - If the element is iterable, recursively apply the filter:
     *   - If $yieldNestedAsArray is true, convert the filtered iterable to an array before yielding.
     *   - Otherwise, yield elements recursively.
     * - Otherwise, yield the element if it is accepted by the filter.
     *
     * @return \Generator Yields key-value pairs of filtered elements.
     */
    public function getIterator(): \Generator
    {
        foreach ($this->iterable as $key => $value) {
            if (is_iterable($value)) {
                // Process nested iterable; yield as array or recursively based on $yieldNestedAsArray.
                if ($this->yieldNestedAsArray) {
                    yield $this->withIterable($value)->toArray();
                } else {
                    yield from $this->withIterable($value)->getIterator();
                }
            } else if ($this->accept($key, $value)) {
                yield $key => $value;
            }
        }
    }

    /**
     * Determines whether the element identified by $key and $value should be accepted.
     *
     * Delegates the check to the provided filter.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated.
     * @return bool True if the element is accepted by the filter; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return $this->filter->accept($key, $value);
    }
}
