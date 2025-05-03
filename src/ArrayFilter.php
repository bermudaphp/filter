<?php

namespace Bermuda\Filter;

/**
 * ArrayFilter
 *
 * Принимает элемент, если значение является массивом.
 */
final class ArrayFilter extends AbstractFilter
{
    public function accept(string|int $key, mixed $value): bool
    {
        return is_array($value);
    }
}
