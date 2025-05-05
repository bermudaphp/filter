<?php

namespace Bermuda\Filter;

/**
 * FileExistsFilter
 *
 * Accepts an element if its value, when interpreted as a file path, exists in the file system.
 */
final class FileExistsFilter extends AbstractFilter
{
    /**
     * Determines whether the given element represents an existing file.
     *
     * @param mixed $value The element to be evaluated (expected to be a string file path).
     * @param string|int|null $key The key associated with the element.
     * @return bool True if the file exists; otherwise, false.
     */
    public function accept(mixed $value, string|int|null $key = null): bool
    {
        return file_exists((string)$value);
    }
}