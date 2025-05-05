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
     * @param int|string $key The key associated with the element.
     * @param mixed $value The element to be evaluated (expected to be a string file path).
     * @return bool True if the file exists; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        return file_exists((string)$value);
    }
}