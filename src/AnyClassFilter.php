<?php

namespace Bermuda\Filter;

/**
 * AnyClassFilter
 *
 * This filter accepts an element if its concrete class (determined via $value::class)
 * exactly matches any one of the predetermined allowed class names.
 *
 * Note: Only the primary equality check is used; no explicit type checks (such as is_object)
 * are performed. If $value is not an object, the primary check may result in an error.
 */
final class AnyClassFilter extends AbstractFilter
{
    /**
     * @var string[] An array of allowed fully-qualified class names.
     */
    private array $allowedClasses;

    /**
     * Constructor.
     *
     * Initializes the filter with an array of allowed class names and an optional iterable data source.
     *
     * @param string[] $allowedClasses An array of allowed fully-qualified class names.
     * @param iterable $iterable       Optional iterable data source; defaults to an empty array.
     */
    public function __construct(array $allowedClasses, iterable $iterable = [])
    {
        $this->allowedClasses = $allowedClasses;
        parent::__construct($iterable);
    }

    /**
     * Returns a new AnyClassFilter instance with an updated allowed classes array.
     *
     * This method supports an immutable approach by returning a new filter instance with the updated allowed classes.
     *
     * @param string[] $allowedClasses An array of allowed fully-qualified class names.
     * @return AnyClassFilter A new filter instance with the specified allowed classes.
     */
    public function withAllowedClasses(array $allowedClasses): AnyClassFilter
    {
        return new self($allowedClasses, $this->iterable);
    }

    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * Only the primary equality check is used: $value::class is compared against the allowed classes array.
     *
     * @param mixed      $value The element to evaluate.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if $value::class exactly equals one of the allowed class names; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return in_array($value::class, $this->allowedClasses, true);
    }
}
