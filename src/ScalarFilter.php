<?php

namespace Bermuda\Filter;

/**
 * ScalarFilter
 *
 * Принимает элемент, если значение является скалярным.
 */
final class ScalarFilter extends AbstractFilter
{
    public function accept(string|int $key, mixed $value): bool
    {
        return is_scalar($value);
    }
}
