<?php

namespace Bermuda\Filter;

/**
 * FileExtensionFilter
 *
 * Accepts an element if its file extension (derived from its string value) is among the allowed list.
 * Comparison can be performed in a case-sensitive or case-insensitive manner.
 */
final class FileExtensionFilter extends AbstractFilter implements FilterInterface
{
    /**
     * @var string[] List of allowed extensions (without dots), e.g., ['jpg', 'png'].
     */
    private array $allowedExtensions;

    /**
     * @var bool Determines whether the comparison is case sensitive.
     *           Defaults to false.
     */
    private bool $caseSensitive;

    /**
     * Constructor.
     *
     * @param array $allowedExtensions An array of allowed file extensions.
     * @param iterable $iterable The data source to be filtered.
     * @param bool $caseSensitive Optional. True for case-sensitive comparison; false otherwise.
     */
    public function __construct(array $allowedExtensions, iterable $iterable = [], bool $caseSensitive = false)
    {
        $this->allowedExtensions = $allowedExtensions;
        $this->caseSensitive = $caseSensitive;
        parent::__construct($iterable);
    }

    /**
     * Returns a new instance with an updated list of allowed file extensions.
     *
     * @param array $allowedExtensions The new array of allowed extensions.
     * @return self A new instance with the updated allowed extensions.
     */
    public function withAllowedExtensions(array $allowedExtensions): self
    {
        $copy = clone $this;
        $copy->allowedExtensions = $allowedExtensions;
        return $copy;
    }

    /**
     * Returns a new instance with an updated case sensitivity setting.
     *
     * @param bool $caseSensitive True for case-sensitive, false for case-insensitive.
     * @return self A new instance with the updated setting.
     */
    public function withCaseSensitive(bool $caseSensitive): self
    {
        $copy = clone $this;
        $copy->caseSensitive = $caseSensitive;
        return $copy;
    }

    /**
     * Determines whether the given file path has an allowed extension.
     *
     * @param int|string $key The key associated with the element.
     * @param mixed $value The file path to evaluate.
     * @return bool True if the file's extension is in the allowed list; otherwise, false.
     */
    public function accept(int|string $key, mixed $value): bool
    {
        $filePath = (string)$value;
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        if ($extension === '') {
            return false;
        }
        if (!$this->caseSensitive) {
            $extension = strtolower($extension);
            $allowed = array_map('strtolower', $this->allowedExtensions);
        } else {
            $allowed = $this->allowedExtensions;
        }
        return in_array($extension, $allowed, true);
    }
}