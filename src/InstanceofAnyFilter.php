<?php

namespace Bermuda\Filter;

/**
 * InstanceofAnyFilter
 *
 * This filter accepts an element if its value is an instance of any one of the provided classes.
 * Only the primary check is performed: each allowed class is tested via the `instanceof` operator.
 *
 * Note: No explicit type checking is performed; the filter relies solely on the `instanceof` operator.
 */
final class InstanceofAnyFilter extends AbstractFilter
{
    /**
     * An array of allowed fully-qualified class names.
     *
     * @var string[]
     */
    private array $classes;

    /**
     * Constructor.
     *
     * Initializes the filter with an array of allowed class names and an optional iterable data source.
     *
     * @param string[] $classes  An array of allowed fully-qualified class names.
     * @param iterable $iterable Optional iterable data source; defaults to an empty array.
     */
    public function __construct(array $classes, iterable $iterable = [])
    {
        $this->classes = $classes;
        parent::__construct($iterable);
    }

    /**
     * Returns a new InstanceofAnyFilter instance with an updated allowed classes array.
     *
     * This provides an immutable way to update the allowed classes.
     *
     * @param string[] $classes An array of allowed fully-qualified class names.
     * @return InstanceofAnyFilter A new filter instance with the updated allowed classes.
     */
    public function withClasses(array $classes): InstanceofAnyFilter
    {
        return new self($classes, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted.
     *
     * Only the primary check is used: the filter iterates through each allowed class and
     * returns true if the value is an instance of any one of those classes.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to evaluate.
     * @return bool Returns true if the element is an instance of any allowed class; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return array_any($this->classes,static fn($class) => $value instanceof $class);
    }
}
