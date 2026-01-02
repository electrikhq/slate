@props([
    'variant' => 'default',
])

@php
    // Base classes
    $baseClasses = 'relative w-full rounded-lg border p-4';
    
    // Variant classes
    // Note: Using base colors (text-success) instead of foreground colors for better readability on light backgrounds
    // Using Tailwind opacity modifiers (/10 for bg, /20 for border) - Tailwind v4 generates these automatically
    $variantClasses = [
        'default' => 'bg-background text-foreground border-border',
        'success' => 'bg-success/10 text-success border-success/20',
        'warning' => 'bg-warning/10 text-warning border-warning/20',
        'info' => 'bg-info/10 text-info border-info/20',
        'error' => 'bg-error/10 text-error border-error/20',
        'danger' => 'bg-danger/10 text-danger border-danger/20',
    ];
    
    // Get variant classes
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
    
    // Build classes
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $variantClass,
        $attributes->get('class'),
    ])));
    
    // ARIA attributes
    $ariaAttributes = [];
    $ariaAttributes['role'] = 'alert';
@endphp

<div 
    {{ $attributes->merge(['class' => $classes])->except(['variant']) }}
    @foreach($ariaAttributes as $attr => $val)
        {{ $attr }}="{{ $val }}"
    @endforeach
>
    {{ $slot }}
</div>

