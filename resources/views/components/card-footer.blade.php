@props([
    // No props needed - CardFooter is a container
])

@php
    // Base classes - matching shadcn/ui exactly
    $baseClasses = 'flex items-center p-6 pt-0';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

