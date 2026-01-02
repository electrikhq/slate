@props([
    'as' => 'h5',
])

@php
    // Base classes
    $baseClasses = 'mb-1 font-medium leading-none tracking-tight';
    
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

