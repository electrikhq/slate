@props([
    'pressed' => false,
    'variant' => 'default',
    'size' => 'default',
    'as' => 'button',
    'type' => 'button',
])

@php
    $isPressed = filter_var($pressed, FILTER_VALIDATE_BOOL);

    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium whitespace-nowrap transition-colors outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*=\'size-\'])]:size-4 [&_svg]:shrink-0';

    $variantClasses = [
        'default' => 'bg-transparent hover:bg-muted hover:text-muted-foreground data-[state=on]:bg-accent data-[state=on]:text-accent-foreground',
        'outline' => 'border border-input bg-transparent shadow-xs hover:bg-accent hover:text-accent-foreground data-[state=on]:bg-accent data-[state=on]:text-accent-foreground',
    ];

    $sizeClasses = [
        'default' => 'h-9 min-w-9 px-2',
        'sm' => 'h-8 min-w-8 px-1.5',
        'lg' => 'h-10 min-w-10 px-2.5',
    ];

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$variant] ?? $variantClasses['default'],
        $sizeClasses[$size] ?? $sizeClasses['default'],
    ]));
@endphp

<{{ $as }}
    data-slot="toggle"
    @if($as === 'button') type="{{ $type }}" @endif
    x-data="{ pressed: {{ $isPressed ? 'true' : 'false' }} }"
    @click="pressed = !pressed"
    x-bind:aria-pressed="pressed ? 'true' : 'false'"
    x-bind:data-state="pressed ? 'on' : 'off'"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
