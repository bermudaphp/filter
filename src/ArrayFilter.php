<?php

namespace Bermuda\Filter;

/**
 * ArrayFilter
 *
 * Принимает элемент, если значение является массивом.
 */
final class ArrayFilter extends AbstractFilter
{
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_array($value);
    }
}
