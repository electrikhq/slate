@props([
    // No props needed - CardHeader is a container
])

@php
    // Base classes
    $baseClasses = 'flex flex-col space-y-1.5 p-6';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

