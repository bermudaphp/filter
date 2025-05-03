<?php

namespace Bermuda\Filter;

/**
 * InstanceofFilter
 *
 * This filter accepts an element if its value is an instance of a specified class.
 * The class name is provided when constructing the filter.
 */
final class InstanceofFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified class name to check against.
     */
    private string $className;

    /**
     * Constructor.
     *
     * Initializes the InstanceofFilter with the fully-qualified class name and an optional iterable data source.
     *
     * @param string   $className The class name the value must be an instance of.
     * @param iterable $iterable  An optional iterable data source. Defaults to an empty array.
     */
    public function __construct(string $className, iterable $iterable = [])
    {
        $this->className = $className;
        parent::__construct($iterable);
    }

    /**
     * Returns a new InstanceofFilter with a different target class name.
     *
     * This method creates a new instance of InstanceofFilter with the updated class name while keeping
     * the current iterable data source intact.
     *
     * @param string $className The new fully-qualified class name to filter against.
     * @return InstanceofFilter A new filter instance with the specified class name.
     */
    public function withClassName(string $className): InstanceofFilter
    {
        return new self($className, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * The element is accepted if its value is an instance of the specified class.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to be evaluated.
     * @return bool Returns true if the value is an instance of the specified class; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return $value instanceof $this->className;
    }
}
