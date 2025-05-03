<?php

namespace Bermuda\Filter;

/**
 * PropertyEqualsFilter
 *
 * Accepts an element if it is an object that has a property matching a specified name
 * and that property's value equals the expected value.
 */
final class PropertyEqualsFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var string The property name to check.
     */
    private string $property;

    /**
     * @var mixed The expected value for that property.
     */
    private mixed $expectedValue;

    /**
     * @var bool Determines whether to use strict (===) comparison.
     */
    private bool $strict;

    /**
     * Constructor.
     *
     * @param string $property The property name to be evaluated.
     * @param mixed $expectedValue The expected value for the property.
     * @param bool $strict Optional boolean flag for strict comparison. Defaults to true.
     * @param iterable $iterable The data source to be filtered.
     */
    public function __construct(string $property, mixed $expectedValue, bool $strict = true, iterable $iterable = [])
    {
        $this->property = $property;
        $this->expectedValue = $expectedValue;
        $this->strict = $strict;
        parent::__construct($iterable);
    }

    /**
     * Determines whether an element is accepted based on the property value equality.
     *
     * The element is accepted only if it is an object, has the specified property,
     * and the property's value equals the expected value (using strict or loose comparison).
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to evaluate.
     * @return bool True if the condition is met; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $propertyValue = $value->{$this->property};
        return $this->strict ? $propertyValue === $this->expectedValue : $propertyValue == $this->expectedValue;
    }
}