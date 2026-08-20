@props([
    'variant' => 'default',
    'as' => 'span',
])

@php
    $baseClasses = 'inline-flex w-fit shrink-0 items-center justify-center gap-1 overflow-hidden rounded-md border px-2 py-0.5 text-xs font-medium whitespace-nowrap transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 [&>svg]:pointer-events-none [&>svg]:size-3';

    $variantClasses = [
        'default' => 'border-transparent bg-primary text-primary-foreground',
        'secondary' => 'border-transparent bg-secondary text-secondary-foreground',
        'destructive' => 'border-transparent bg-destructive text-white dark:bg-destructive/60',
        'outline' => 'text-foreground',
    ];

    $hoverClasses = $as === 'a'
        ? [
            'default' => 'hover:bg-primary/90',
            'secondary' => 'hover:bg-secondary/90',
            'destructive' => 'hover:bg-destructive/90',
            'outline' => 'hover:bg-accent hover:text-accent-foreground',
        ][$variant] ?? ''
        : '';

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$variant] ?? $variantClasses['default'],
        $hoverClasses,
    ]));
@endphp

<{{ $as }}
    data-slot="badge"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
