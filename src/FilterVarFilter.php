<?php

namespace Bermuda\Filter;

/**
 * FilterVarFilter
 *
 * Applies PHP's filter_var() function to each element's value.
 * The element is accepted if filter_var() returns a value that is not false.
 * This filter is generic and can be used for various validation and sanitization tasks.
 */
final class FilterVarFilter extends AbstractFilter
{
    /**
     * @var int The filter constant to be used with filter_var, e.g., FILTER_VALIDATE_EMAIL.
     */
    private int $filterConstant;

    /**
     * @var array|null Optional associative array of options and/or flags for filter_var.
     */
    private ?array $options;

    /**
     * Constructor.
     *
     * @param int        $filterConstant The filter constant (e.g., FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_STRING, etc.).
     * @param iterable   $iterable       The data source to be filtered.
     * @param array|null $options        Optional options and flags for filter_var.
     */
    public function __construct(int $filterConstant, iterable $iterable = [], ?array $options = null)
    {
        $this->filterConstant = $filterConstant;
        $this->options = $options;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with the updated filter constant.
     *
     * @param int $filterConstant The new filter constant.
     * @return self A new FilterVarFilter instance with the updated filter constant.
     */
    public function withFilterConstant(int $filterConstant): self
    {
        $copy = clone $this;
        $copy->filterConstant = $filterConstant;
        return $copy;
    }

    /**
     * Returns a new instance with updated options for filter_var.
     *
     * @param array|null $options The new options and flags.
     * @return self A new FilterVarFilter instance with the updated options.
     */
    public function withOptions(?array $options): self
    {
        $copy = clone $this;
        $copy->options = $options;
        return $copy;
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * The element is accepted if filter_var($value, $filterConstant, $options) returns a result that is not false.
     *
     * @param int|string $key   The key associated with the element (unused in this filter).
     * @param mixed      $value The element to be evaluated.
     * @return bool Returns true if the element passes the filter_var check; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        // Apply filter_var with the specified filter constant and options.
        $result = filter_var($value, $this->filterConstant, $this->options ?? []);
        return $result !== false;
    }
}
