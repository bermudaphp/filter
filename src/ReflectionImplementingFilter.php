<?php

namespace Bermuda\Filter;

/**
 * ReflectionImplementingFilter
 *
 * Accepts a reflection element if it represents a class that implements the specified interface.
 * The filter assumes that each element is an instance of \ReflectionClass.
 */
final class ReflectionImplementingFilter extends AbstractFilter
{
    /**
     * @var string The fully-qualified name of the interface that the class must implement.
     */
    private string $interfaceName;

    /**
     * Constructor.
     *
     * @param string $interfaceName The fully-qualified interface name.
     * @param iterable $iterable The data source containing reflection elements.
     */
    public function __construct(string $interfaceName, iterable $iterable = [])
    {
        $this->interfaceName = $interfaceName;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated interface name.
     *
     * @param string $interfaceName The new interface name.
     * @return self A new ReflectionImplementingFilter instance with the specified interface name.
     */
    public function withInterfaceName(string $interfaceName): self
    {
        $copy = clone $this;
        $copy->interfaceName = $interfaceName;
        return $copy;
    }

    /**
     * Determines whether the given reflection element should be accepted.
     *
     * The element is accepted if it is a ReflectionClass instance and the class implements the
     * specified interface.
     *
     * @param \ReflectionClass $value The reflection element to evaluate.
     * @param string|int|null $key The key associated with the reflection element.
     * @return bool True if $value is a ReflectionClass and implements $this->interfaceName; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        // Accept the element if it implements the specified interface.
        return $value?->implementsInterface($this->interfaceName) ?? false;
    }
}