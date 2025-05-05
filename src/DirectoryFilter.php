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
     * @param int|string $key The key associated with the element.
     * @param mixed $value The file path to evaluate.
     * @return bool True if the path is an existing directory; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return is_dir((string)$value);
    }
}