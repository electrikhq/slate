@props([
    'as' => 'h3', // Default to h3, but can be overridden
])

@php
    // Base classes
    // Typography: h3 uses text-2xl font-semibold tracking-tight per Pattern 6
    $baseClasses = 'text-2xl font-semibold leading-none tracking-tight';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
    
    // Determine the HTML tag
    $tag = $as;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes])->except(['as']) }}>
    {{ $slot }}
</{{ $tag }}>

