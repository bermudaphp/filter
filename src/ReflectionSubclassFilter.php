<?php

namespace Bermuda\Filter;

/**
 * ReflectionSubclassFilter
 *
 * Accepts a reflection element if it represents a class that is a subclass
 * of a given parent class. It assumes that each element is an instance of
 * \ReflectionClass and uses its isSubclassOf() method.
 */
final class ReflectionSubclassFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified name of the parent class.
     */
    private string $parentClass;

    /**
     * Constructor.
     *
     * @param string   $parentClass The fully-qualified name of the parent class.
     * @param iterable $iterable    The data source containing \ReflectionClass elements.
     */
    public function __construct(string $parentClass, iterable $iterable = [])
    {
        $this->parentClass = $parentClass;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated parent class.
     *
     * @param string $parentClass The new parent class name.
     * @return self A new ReflectionSubclassFilter instance with the specified parent class.
     */
    public function withParentClass(string $parentClass): self
    {
        $copy = clone $this;
        $copy->parentClass = $parentClass;
        return $copy;
    }

    /**
     * Determines whether the given reflection element should be accepted.
     *
     * The element is accepted if it is a subclass of the specified parent class.
     *
     * @param int|string $key   The key associated with the reflection element.
     * @param \ReflectionClass      $value The \ReflectionClass element to evaluate.
     * @return bool True if the reflection class is a subclass of the specified parent class; false otherwise.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return $value?->isSubclassOf($this->parentClass) ?? false;
    }
}
