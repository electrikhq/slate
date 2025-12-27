@props([
    'variant' => 'default',
    'size' => 'default',
    'color' => null,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    
    // Size classes - matching shadcn/ui exactly
    $sizeClasses = [
        'sm' => 'h-9 px-3 text-sm',
        'default' => 'h-10 px-4 py-2',
        'lg' => 'h-11 px-8',
    ];
    
    // Variant classes
    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'success' => 'bg-success text-success-foreground hover:bg-success/90',
        'warning' => 'bg-warning text-warning-foreground hover:bg-warning/90',
        'info' => 'bg-info text-info-foreground hover:bg-info/90',
        'error' => 'bg-error text-error-foreground hover:bg-error/90',
        'danger' => 'bg-danger text-danger-foreground hover:bg-danger/90',
        'outline' => 'border border-input bg-background hover:bg-accent hover:text-accent-foreground',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];
    
    // Color override (if specified)
    if ($color === 'primary') {
        $variantClasses['default'] = 'bg-primary text-primary-foreground hover:bg-primary/90';
    } elseif ($color === 'secondary') {
        $variantClasses['default'] = 'bg-secondary text-secondary-foreground hover:bg-secondary/80';
    } elseif ($color === 'success') {
        $variantClasses['default'] = 'bg-success text-success-foreground hover:bg-success/90';
    } elseif ($color === 'warning') {
        $variantClasses['default'] = 'bg-warning text-warning-foreground hover:bg-warning/90';
    } elseif ($color === 'info') {
        $variantClasses['default'] = 'bg-info text-info-foreground hover:bg-info/90';
    } elseif ($color === 'error') {
        $variantClasses['default'] = 'bg-error text-error-foreground hover:bg-error/90';
    } elseif ($color === 'danger') {
        $variantClasses['default'] = 'bg-danger text-danger-foreground hover:bg-danger/90';
    }
    
    $classes = trim($baseClasses . ' ' . ($sizeClasses[$size] ?? $sizeClasses['default']) . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']));
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>

