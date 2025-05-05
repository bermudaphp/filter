<?php

namespace Bermuda\Filter;

/**
 * PercentageFilter
 *
 * This filter passes only a specified percentage of elements.
 * For example, with a filter percentage of 70, the filter will reject 70% of the elements
 * and allow only the remaining 30% to pass through.
 *
 * The allowed count is determined by:
 *      allowedCount = floor(totalElements * ((100 - filterPercentage) / 100))
 *
 * The filter is stateful:
 * - It maintains an internal counter that is incremented on each accepted element.
 * - The counter and allowed count are reset at the start of iteration.
 * - Additionally, if the provided iterable is not an array, it will be converted to one.
 */
final class PercentageFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var float The percentage of elements to filter out (value between 0 and 100).
     */
    private float $filterPercentage;

    /**
     * @var int|null The number of elements that are allowed to pass.
     */
    private ?int $allowedCount = null;

    /**
     * @var int The number of elements that have been accepted so far.
     */
    private int $counter = 0;

    private ?array $data = null;

    /**
     * Constructor.
     *
     * @param float $filterPercentage The percentage of elements to filter out.
     *                                   For example, 70 will remove 70% of the elements.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(float $filterPercentage, iterable $iterable = [])
    {
        $this->filterPercentage = $filterPercentage;
        parent::__construct($iterable);
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * On the first call, the method calculates how many elements are allowed to pass
     * based on the total element count and the specified filter percentage.
     * Then it accepts elements until this allowed count is reached.
     *
     * @param mixed $value The element to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool Returns true if the element is within the allowed count; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        // Calculate the allowed count on the first call.
        if ($this->allowedCount === null) {
            $total = count($this->iterable);
            $this->allowedCount = (int)floor($total * ((100 - $this->filterPercentage) / 100));
        }

        // If we have not yet accepted the allowed number of items, accept this element.
        if ($this->counter < $this->allowedCount) {
            $this->counter++;
            return true;
        }
        return false;
    }

    /**
     * Returns an iterator that yields each element passing the filter.
     *
     * Before iteration begins, the internal counter and allowed count are reset
     * to ensure correct behavior on multiple iterations.
     *
     * @return \Generator A generator yielding the filtered key-value pairs.
     */
    public function getIterator(): \Generator
    {
        if (!$this->data && !is_array($this->iterable)) {
            $this->iterable = iterator_to_array($this->iterable);
        }

        $this->counter = 0;
        $this->allowedCount = null;

        return parent::getIterator();
    }
}