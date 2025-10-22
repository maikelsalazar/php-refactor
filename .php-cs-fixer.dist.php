<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Define which files and folders to scan
$finder = Finder::create()
    ->in(__DIR__ . '/src')   // Include all PHP files under src
    ->in(__DIR__ . '/tests') // Include all PHP files under tests
    ->name('*.php')                     // Only PHP files
    ->ignoreDotFiles(true)              // Ignore hidden files like .gitignore
    ->ignoreVCS(true);                  // Ignore version control system folders like .git

// Configure PHP-CS-Fixer
return (new Config())
    ->setRiskyAllowed(true) // Allow risky rules that might change behavior
    ->setRules([
        '@PSR12' => true,                  // Base standard: PSR-12
        'array_syntax' => ['syntax' => 'short'], // Use [] instead of array()
        'declare_strict_types' => true,    // Add declare(strict_types=1);
        'no_unused_imports' => true,       // Remove unused imports
        'ordered_imports' => ['sort_algorithm' => 'alpha'], // Sort imports alphabetically
        'single_quote' => true,            // Use single quotes whenever possible
        'no_trailing_whitespace' => true,  // Remove trailing whitespaces
        'trim_array_spaces' => true,       // Trim spaces inside arrays
        'binary_operator_spaces' => ['default' => 'align_single_space'], // Align operators
        'blank_line_after_namespace' => true, // Add a blank line after namespace
        'blank_line_after_opening_tag' => true, // Add a blank line after <?php
        'concat_space' => ['spacing' => 'one'], // Space around string concatenation
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'], // Format multiline args
        'phpdoc_align' => ['align' => 'vertical'], // Align PHPDoc annotations vertically
    ])
    ->setFinder($finder);

