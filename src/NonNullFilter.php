<?php

namespace Bermuda\Filter;

/**
 * NonNullFilter accepts only values that are not null.
 *
 * This filter is useful to remove null values from an iterable dataset.
 */
final class NonNullFilter extends AbstractFilter
{
    public function accept(int|string $key, mixed $value): bool
    {
        return $value !== null;
    }
}