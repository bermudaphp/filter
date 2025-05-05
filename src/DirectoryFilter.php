<?php

namespace Bermuda\Filter;

/**
 * DirectoryFilter
 *
 * Accepts an element if its value, when treated as a file path, is a directory.
 */
final class DirectoryFilter extends AbstractFilter
{
    /**
     * Determines whether the given element is an existing directory.
     *
     * @param mixed $value The file path to evaluate.
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the path is an existing directory; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return is_dir((string)$value);
    }
}