@props([
    'for' => null,
    'required' => false,
    'size' => 'default',
    'error' => false,
])

@php
    // Base classes (without text size, handled by size)
    // Note: Small typography uses font-medium, which is appropriate for labels
    $baseClasses = 'font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70';
    
    // Size classes (includes text size)
    $sizeClasses = [
        'sm' => 'text-xs',
        'default' => 'text-sm',
        'lg' => 'text-base',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Error state classes
    $errorClasses = $error ? 'text-danger' : 'text-foreground';
    
    // Required indicator classes
    $requiredClasses = $required ? 'after:content-["*"] after:ml-0.5 after:text-danger' : '';
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $sizeClass,
        $errorClasses,
        $requiredClasses,
        $attributes->get('class'),
    ])));
@endphp

<label
    @if($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => $classes])->except(['for', 'required', 'size', 'error']) }}
>
    {{ $slot }}
</label>

