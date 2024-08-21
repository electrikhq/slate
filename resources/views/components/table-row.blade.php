@props([
    'hoverable' => false, // Option to highlight row on hover
    'striped' => false, // Option for striped rows
    'even' => false, // For handling alternating row colors
])

@php
$rowClasses = [
    $hoverable ? 'hover:bg-neutral-100 dark:hover:bg-neutral-800' : '',
    $striped && $even ? 'bg-neutral-50 dark:bg-neutral-900' : '',
];
@endphp

<tr {{ $attributes->merge(['class' => implode(' ', $rowClasses)]) }}>
    {{ $slot }}
</tr>
