<?php

namespace Bermuda\Filter;

/**
 * CallbackFilter
 *
 * This filter accepts an element if the provided callback returns true for that element.
 * The callback should be a callable accepting two parameters ($key and $value) and returning a boolean.
 */
final class CallbackFilter extends AbstractFilter
{
    /**
     * @var callable A callback function that determines if an element should be accepted.
     */
    private $callback;

    /**
     * Constructor.
     *
     * Initializes the CallbackFilter with a callable and an optional iterable data source.
     *
     * @param callable $callback A function that accepts ($key, $value) and returns a bool.
     * @param iterable $iterable Optional iterable data source, defaults to an empty array.
     */
    public function __construct(callable $callback, iterable $iterable = [])
    {
        $this->callback = $callback;
        parent::__construct($iterable);
    }

    /**
     * Returns a new CallbackFilter instance with a different callback.
     *
     * This provides an immutable way to update the filtering callback.
     *
     * @param callable $callback A new callback function.
     * @return CallbackFilter A new filter instance with the updated callback.
     */
    public function withCallback(callable $callback): CallbackFilter
    {
        return new self($callback, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the main check is performed: if the callback returns true when called with ($key, $value),
     * the element is accepted. No additional type checks are performed.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if the callback returns true; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return ($this->callback)($key, $value);
    }
}
