<?php

namespace Bermuda\Filter;

final class CallableFilter extends AbstractFilter
{
    public function accept(string|int $key, mixed $value): bool
    {
        return is_callable($value);
    }
}
