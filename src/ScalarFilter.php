<?php

namespace Bermuda\Filter;

final class ScalarFilter extends AbstractFilter
{
    public function accept(string|int $key, mixed $value): bool
    {
        return is_scalar($value);
    }
}
