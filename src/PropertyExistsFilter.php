<?php

namespace Bermuda\Filter;

;

/**
 * PropertyExistsFilter
 *
 * Accepts an element if the specified property exists on the value.
 * This filter simply uses PHP's native property_exists() function without any auxiliary checks.
 */
final class PropertyExistsFilter extends AbstractFilter
{
    /**
     * @var string The name of the property to check for existence.
     */
    private string $property;

    /**
     * Constructor.
     *
     * @param string $property The name of the property to look for.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(string $property, iterable $iterable = [])
    {
        $this->property = $property;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated property name.
     *
     * @param string $property The new property name to check for.
     * @return self A new PropertyExistsFilter instance with the updated property.
     */
    public function withProperty(string $property): self
    {
        $copy = clone $this;
        $copy->property = $property;
        return $copy;
    }

    /**
     * Evaluates whether the specified property exists on the element.
     *
     * This method uses PHP's native property_exists() function to determine if the property exists.
     * No additional type or existence checks are performed.
     *
     * @param mixed $value The element to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool Returns true if property_exists($value, $this->property) returns true; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return property_exists($value, $this->property);
    }
}