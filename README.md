## PHP Iterable Filter Library ##
This library provides a robust and extensible set of filters to process and filter iterable data sources in PHP. Its design follows a consistent interface that makes it easy to apply custom filtering logic to collections (arrays, Traversable, etc.). With immutable filter instances and a fluent API, you can chain and compose filters to build complex filtering rules easily.

## Features
# Flexible Filtering Interface: The library defines a common FilterInterface that extends both \IteratorAggregate and Arrayable, so you can directly iterate over filtered results and convert them to arrays.

# Abstract Base Class: The AbstractFilter class implements most of the common functionality, including a generator-based iterator (getIterator()) and an immutable withIterable() method for setting the data source.

# Wide Range of Built-in Filters: The library includes filters for various use cases, including:

# Value-based Filters: EqualsFilter, NotEqualsFilter, EmptyFilter, NotEmptyFilter, StringEqualsFilter, and many more.

# Numeric Filters: GreaterThanFilter, LessThanFilter, GreaterThanEqualsFilter, LessThanEqualsFilter, as well as range filters.

# Array Filters: Filters using PHP’s built-in functions such as array_intersect, array_diff, etc.

# Key-based Filters: Filters that compare only the element's key (e.g., KeyIntersectFilter, KeyContainsFilter, KeyRegexFilter, etc.).

# Object Property Filters: e.g. PropertyExistsFilter.

# Composite Filters: Easily combine multiple filters using a composite pattern (e.g., ChanableFilter).

# Easy to Extend: Creating a custom filter is as simple as extending the AbstractFilter class and implementing the accept() method.

## Installation
```bash
composer require bermudaphp/filter
```

## Usage
