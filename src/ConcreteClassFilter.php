<?php

namespace Bermuda\Filter;

/**
 * ConcreteClassFilter
 *
 * This filter accepts an element if its value's concrete class (obtained via $value::class)
 * exactly matches the specified fully-qualified class name. It does not perform any extra type checking.
 *
 * Note: If $value is not an object, $value::class will not be available, and this check will simply return false.
 */
final class ConcreteClassFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified class name that the object's concrete class must exactly match.
     */
    private string $className;

    /**
     * Constructor.
     *
     * Initializes the filter with a specific class name and an optional iterable data source.
     *
     * @param string   $className The fully-qualified class name that the object's concrete class must exactly match.
     * @param iterable $iterable  An optional iterable data source to filter; defaults to an empty array.
     */
    public function __construct(string $className, iterable $iterable = [])
    {
        $this->className = $className;
        parent::__construct($iterable);
    }

    /**
     * Returns a new ConcreteClassFilter instance with a different target class name.
     *
     * This supports immutability by returning a new instance with the updated class name,
     * while retaining the current iterable data source.
     *
     * @param string $className The new fully-qualified class name.
     * @return ConcreteClassFilter A new filter instance with the specified class name.
     */
    public function withClassName(string $className): ConcreteClassFilter
    {
        return new self($className, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the main check is performed: the concrete class of $value (via $value::class) must
     * exactly equal the specified target class. No additional type checking is done.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if $value::class exactly equals the target class; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return $value::class === $this->className;
    }
}
