@props([
    'variant' => 'default',
    'size' => 'default',
    'animation' => 'auto',
    'as' => 'button',
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all motion-reduce:transform-none motion-reduce:transition-none outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*="size-"])]:size-4';

    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
        'outline' => 'border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:border-input dark:bg-input/30 dark:hover:bg-input/50',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50',
        'destructive' => 'bg-destructive text-white hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:bg-destructive/60 dark:focus-visible:ring-destructive/40',
        'link' => 'text-primary underline-offset-4 hover:underline',
    ];

    $sizeClasses = [
        'xs' => 'h-6 gap-1 rounded-md px-2 text-xs has-[>svg]:px-1.5 [&_svg:not([class*="size-"])]:size-3',
        'sm' => 'h-8 gap-1.5 rounded-md px-3 has-[>svg]:px-2.5',
        'default' => 'h-9 px-4 py-2 has-[>svg]:px-3',
        'lg' => 'h-10 rounded-md px-6 has-[>svg]:px-4',
        'icon' => 'size-9',
        'icon-xs' => 'size-6 rounded-md [&_svg:not([class*="size-"])]:size-3',
        'icon-sm' => 'size-8',
        'icon-lg' => 'size-10',
    ];

    $resolvedAnimation = $animation === 'auto'
        ? ($variant === 'link' ? 'none' : 'subtle')
        : $animation;

    $animationClasses = [
        'none' => '',
        'subtle' => 'motion-safe:hover:-translate-y-px motion-safe:active:translate-y-0',
        'lift' => 'motion-safe:hover:-translate-y-0.5 motion-safe:hover:shadow-sm motion-safe:active:translate-y-0',
    ];

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$variant] ?? $variantClasses['default'],
        $sizeClasses[$size] ?? $sizeClasses['default'],
        $animationClasses[$resolvedAnimation] ?? $animationClasses['subtle'],
    ]));
@endphp

<{{ $as }}
    data-slot="button"
    @if($as === 'button') type="{{ $type }}" @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
