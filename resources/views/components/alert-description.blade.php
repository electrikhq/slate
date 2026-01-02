@props([
    'as' => 'div',
])

@php
    // Base classes
    $baseClasses = 'text-sm [&_p]:leading-relaxed';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
    
    $tag = $as;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes])->except(['as']) }}>
    {{ $slot }}
</{{ $tag }}>

