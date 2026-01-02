@props([
    // No props needed - Card is a container component
])

@php
    // Base classes
    // Using shadow-sm for depth, very subtle border-border for definition
    // Border is optional - can be removed for softer look (shadow-only)
    $baseClasses = 'rounded-lg border border-border bg-card text-card-foreground shadow-xs';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>

