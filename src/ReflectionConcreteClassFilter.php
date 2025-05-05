<?php

namespace Bermuda\Filter;

use Bermuda\Reflection\ReflectionClass;

/**
 * ReflectionConcreteClassFilter
 *
 * Accepts a reflection element if its class name is present in the provided array of allowed class names.
 * Instead of checking whether the class is instantiable, this filter compares the class name (as returned by
 * getName()) with an internal list of fully qualified class names.
 *
 * This filter assumes that each element is an instance of \ReflectionClass.
 */
final class ReflectionConcreteClassFilter extends AbstractFilter
{
    /**
     * @var array The list of allowed class names.
     */
    private array $allowedClassNames;

    /**
     * Constructor.
     *
     * @param array    $allowedClassNames An array of allowed fully-qualified class names.
     * @param iterable $iterable          The data source containing reflection elements.
     */
    public function __construct(array $allowedClassNames, iterable $iterable = [])
    {
        $this->allowedClassNames = $allowedClassNames;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated list of allowed class names.
     *
     * @param array $allowedClassNames The new array of allowed class names.
     * @return self A new ReflectionConcreteClassFilter instance with the updated allowed class names.
     */
    public function withAllowedClassNames(array $allowedClassNames): self
    {
        $copy = clone $this;
        $copy->allowedClassNames = $allowedClassNames;
        return $copy;
    }

    /**
     * Determines whether the given reflection element should be accepted.
     *
     * The element is accepted if the class name (as returned by getName()) is in the allowed class names array.
     *
     * @param int|string $key   The key associated with the reflection element.
     * @param ReflectionClass      $value The reflection element to evaluate.
     * @return bool True if $value->getName() is present in the allowed class names; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return in_array($value?->getName() ?? null, $this->allowedClassNames, true);
    }
}
