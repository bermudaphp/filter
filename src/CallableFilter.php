<?php

namespace Bermuda\Filter;

final class CallableFilter extends AbstractFilter
{
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_callable($value);
    }
}
