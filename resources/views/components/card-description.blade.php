@props([
    // No props needed - CardDescription is a text element
])

@php
    // Base classes - matching shadcn/ui exactly
    // Typography: Muted text uses text-sm (normal weight) per Pattern 6
    $baseClasses = 'text-sm text-muted-foreground';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</p>

