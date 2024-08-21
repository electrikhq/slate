@props([
    'striped' => false, // Option to add striped rows
    'bordered' => false, // Option to add borders
    'hoverable' => false, // Option to highlight rows on hover
    'responsive' => true, // Option to make the table responsive
    'size' => 'md', // Size of the table: 'sm', 'md', 'lg'
])

@php
// Define size classes for padding and text size
$sizes = [
    'sm' => 'text-sm',
    'md' => 'text-base', // Default size
    'lg' => 'text-lg',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Determine table classes based on props
$tableClasses = [
    'table-auto w-full',
    $striped ? 'table-striped' : '',
    $bordered ? 'border border-neutral-300 dark:border-neutral-700' : '',
    $hoverable ? 'table-hover' : '',
    $sizeClass,
];
@endphp

<div class="{{ $responsive ? 'overflow-x-auto' : '' }}">
    <table {{ $attributes->merge(['class' => implode(' ', $tableClasses)]) }}>
        {{ $slot }}
    </table>
</div>
