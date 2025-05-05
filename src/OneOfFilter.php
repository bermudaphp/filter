<?php

namespace Bermuda\Filter;

/**
 * OneOfFilter
 *
 * This filter accepts an element if at least one filter in the chain accepts it.
 * It extends ChainableFilter, but overrides the accept() method so that the element is accepted
 * if any one of the contained filters returns true.
 */
class OneOfFilter extends ChainableFilter
{
    /**
     * Determines whether the given element should be accepted by the OneOfFilter.
     *
     * For the given key and value, at least one filter in the chain must accept the element.
     * This is evaluated using the helper function array_any(), which returns true if the callback yields true
     * for at least one element in the filters list.
     *
     * @param mixed      $value The element to be evaluated.
     * @param string|int|null $key   The key associated with the element.
     * @return bool Returns true if at least one filter accepts the element; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return array_any($this->filters, static fn($filter) => $filter->accept($value, $key));
    }
}
