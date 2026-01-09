{{-- spinner.blade.php --}}
@props([
    'size' => 'md', // xs, sm, md, lg, xl
    'variant' => 'default', // default, primary, secondary, muted
])

@php
    $sizeClasses = [
        'xs' => 'h-3 w-3',
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
        'xl' => 'h-8 w-8',
    ];
    
    $variantClasses = [
        'default' => 'text-foreground',
        'primary' => 'text-primary',
        'secondary' => 'text-secondary',
        'muted' => 'text-muted-foreground',
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
    
    $classes = trim("animate-spin {$sizeClass} {$variantClass} " . ($attributes->get('class') ?? ''));
@endphp

<svg
    class="{{ $classes }}"
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    {{ $attributes->except('class') }}
    role="status"
    aria-label="Loading"
>
    <circle
        class="opacity-25"
        cx="12"
        cy="12"
        r="10"
        stroke="currentColor"
        stroke-width="4"
    ></circle>
    <path
        class="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
    ></path>
</svg>

