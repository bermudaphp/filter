<?php

namespace Bermuda\Filter;

/**
 * ReflectionAttributeFilter
 *
 * Accepts a reflection element if it has at least one attribute
 * matching the specified attribute name.
 *
 * This filter checks a reflection object (such as a ReflectionClass,
 * ReflectionMethod, or ReflectionFunction) by calling its getAttributes()
 * method with the provided attribute name. If one or more matching attributes
 * are found, the element will be accepted.
 */
final class ReflectionAttributeFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified name of the attribute to check for.
     */
    private string $attributeName;

    /**
     * Constructor.
     *
     * @param string   $attributeName The attribute name to check.
     * @param iterable $iterable      The data source containing reflection elements.
     */
    public function __construct(string $attributeName, iterable $iterable = [])
    {
        $this->attributeName = $attributeName;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated attribute name.
     *
     * @param string $attributeName The new attribute name.
     * @return self A new ReflectionAttributeFilter instance with the specified attribute name.
     */
    public function withAttributeName(string $attributeName): self
    {
        $copy = clone $this;
        $copy->attributeName = $attributeName;
        return $copy;
    }

    /**
     * Determines whether the provided reflection element should be accepted.
     *
     * The element is accepted if calling getAttributes() with the specified attribute name
     * returns a non-empty array.
     *
     * @param int|string $key   The key associated with the reflection element.
     * @param \ReflectionClass|\ReflectionFunction      $value The reflection element to evaluate.
     * @return bool True if the element has the specified attribute; false otherwise.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $attributes = $value?->getAttributes($this->attributeName) ?? 0;
        return count($attributes) > 0;
    }
}
