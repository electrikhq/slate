@props([
    // No props needed - CardContent is a container
])

@php
    // Base classes - matching shadcn/ui pattern
    // Default: p-6 (full padding) for standalone content
    // When header exists above, user should add pt-0 to remove top padding
    // This way: standalone content works by default, header+content works with pt-0
    $baseClasses = 'p-6';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

