<?php

namespace Bermuda\Filter;

final class ScalarFilter extends AbstractFilter
{
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_scalar($value);
    }
}
