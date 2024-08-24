@props([
    'color' => 'primary', // Color of the header
])

@php
$colorClass = "bg-{$color}-100 text-{$color}-800 dark:bg-{$color}-900 dark:text-{$color}-200";
@endphp

<thead {{ $attributes->merge(['class' => $colorClass]) }}>
    <tr>
        {{ $slot }}
    </tr>
</thead>
