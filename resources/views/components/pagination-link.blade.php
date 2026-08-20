@props([
    'isActive' => false,
    'size' => 'icon',
    'as' => 'a',
    'href' => '#',
])

@php
    $active = filter_var($isActive, FILTER_VALIDATE_BOOL);

    $base = 'inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium whitespace-nowrap transition-colors outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0';

    $sizeClasses = [
        'default' => 'h-9 px-4 py-2',
        'icon' => 'size-9',
        'sm' => 'h-8 px-3',
    ];

    $variantClasses = $active
        ? 'border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground'
        : 'hover:bg-accent hover:text-accent-foreground';

    $classes = trim(implode(' ', [
        $base,
        $sizeClasses[$size] ?? $sizeClasses['icon'],
        $variantClasses,
    ]));
@endphp

<{{ $as }}
    data-slot="pagination-link"
    @if($active) aria-current="page" @endif
    @if($as === 'a') href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
