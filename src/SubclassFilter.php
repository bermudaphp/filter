<?php

namespace Bermuda\Filter;

/**
 * SubclassFilter
 *
 * This filter accepts an element if its value's class is a subclass of a specified parent class.
 * Only the main check (is_subclass_of) is used, and no auxiliary type checks (such as is_object) are performed.
 *
 * Note: If the value is not an object, is_subclass_of() will return false.
 */
final class SubclassFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified class name representing the parent class.
     */
    private string $parentClass;

    /**
     * Constructor.
     *
     * Initializes the SubclassFilter with the fully-qualified parent class name and an optional iterable data source.
     *
     * @param string   $parentClass The parent class that the object's class should extend.
     * @param iterable $iterable    The optional data source for filtering. Defaults to an empty array.
     */
    public function __construct(string $parentClass, iterable $iterable = [])
    {
        $this->parentClass = $parentClass;
        parent::__construct($iterable);
    }

    /**
     * Returns a new SubclassFilter instance with a different parent class.
     *
     * @param string $parentClass The new fully-qualified parent class name.
     * @return SubclassFilter A new filter instance with the updated parent class.
     */
    public function withParentClass(string $parentClass): SubclassFilter
    {
        return new self($parentClass, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the main check is used: is_subclass_of($value, $this->parentClass).
     * No explicit type checking is performed here (e.g. is_object($value) is omitted).
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if is_subclass_of($value, $this->parentClass) returns true; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return is_subclass_of($value, $this->parentClass);
    }
}
