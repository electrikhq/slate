@props([
    'color' => 'primary', // Color of the footer
])

@php
$colorClass = "bg-{$color}-100 text-{$color}-800 dark:bg-{$color}-900 dark:text-{$color}-200";
@endphp

<tfoot {{ $attributes->merge(['class' => $colorClass]) }}>
    <tr>
        {{ $slot }}
    </tr>
</tfoot>
