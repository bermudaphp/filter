<?php

namespace Bermuda\Filter;

/**
 * IsInterfaceFilter
 *
 * This filter accepts an element if its value is an interface with that name exists.
 * It uses PHP's interface_exists() function to verify that the interface is defined.
 */
final class IsInterfaceFilter extends AbstractFilter
{
    /**
     * Determines whether the given element should be accepted by the filter.
     *
     * The element is accepted if its value is an interface name for which
     * interface_exists() returns true.
     *
     * @param string|int $key   The key associated with the element.
     * @param mixed      $value The element to be evaluated.
     *
     * @return bool Returns true if the value is a string and a valid interface exists with that name; otherwise, false.
     */
    public function accept(string|int $key, mixed $value): bool
    {
        return interface_exists($value);
    }
}
