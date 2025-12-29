@props([
    'variant' => 'default',
    'size' => 'default',
])

@php
    // Base classes
    $baseClasses = 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2';
    
    // Size classes
    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-xs',
        'default' => 'px-2.5 py-0.5 text-xs',
        'lg' => 'px-3 py-1 text-sm',
    ];
    
    // Variant classes
    $variantClasses = [
        'default' => 'border-transparent bg-primary text-primary-foreground hover:bg-primary/80',
        'secondary' => 'border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'success' => 'border-transparent bg-success text-success-foreground hover:bg-success/80',
        'warning' => 'border-transparent bg-warning text-warning-foreground hover:bg-warning/80',
        'info' => 'border-transparent bg-info text-info-foreground hover:bg-info/80',
        'error' => 'border-transparent bg-error text-error-foreground hover:bg-error/80',
        'danger' => 'border-transparent bg-danger text-danger-foreground hover:bg-danger/80',
        'outline' => 'text-foreground border-border',
    ];
    
    // Get size classes
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Get variant classes
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $sizeClass,
        $variantClass,
        $attributes->get('class'),
    ])));
@endphp

<span {{ $attributes->merge(['class' => $classes])->except(['variant', 'size']) }}>
    {{ $slot }}
</span>

