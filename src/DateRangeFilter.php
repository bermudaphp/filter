<?php

namespace Bermuda\Filter;

/**
 * DateRangeFilter
 *
 * Accepts an element if its value, when parsed as a date, falls between the specified minimum and maximum dates.
 */
final class DateRangeFilter extends AbstractFilter
{
    /**
     * @var int The minimum date timestamp.
     */
    private int $minTimestamp;

    /**
     * @var int The maximum date timestamp.
     */
    private int $maxTimestamp;

    /**
     * Constructor.
     *
     * @param string $minDate A date string representing the minimum allowed date.
     * @param string $maxDate A date string representing the maximum allowed date.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(string $minDate, string $maxDate, iterable $iterable = [])
    {
        $this->minTimestamp = strtotime($minDate);
        $this->maxTimestamp = strtotime($maxDate);
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated minimum date.
     *
     * @param string $minDate The new minimum date; must be parsable by strtotime.
     * @return self A new DateRangeFilter instance with the updated minimum date.
     */
    public function withMinDate(string $minDate): self
    {
        $copy = clone $this;
        $copy->minTimestamp = strtotime($minDate);
        return $copy;
    }

    /**
     * Returns a new instance with an updated maximum date.
     *
     * @param string $maxDate The new maximum date; must be parsable by strtotime.
     * @return self A new DateRangeFilter instance with the updated maximum date.
     */
    public function withMaxDate(string $maxDate): self
    {
        $copy = clone $this;
        $copy->maxTimestamp = strtotime($maxDate);
        return $copy;
    }

    /**
     * Determines whether the element's date value is within the specified date range.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated; should be a date string.
     * @return bool True if the date (converted to timestamp) falls between min and max; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $timestamp = strtotime((string)$value);
        if ($timestamp === false) {
            return false;
        }
        return ($timestamp >= $this->minTimestamp && $timestamp <= $this->maxTimestamp);
    }
}