@props([
    'variant' => 'icon',
    'as' => 'div',
])

@php
    $variantClasses = [
        'default' => 'mb-2 text-muted-foreground [&_svg]:size-10',
        'icon' => 'mb-2 flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-muted text-foreground [&_svg]:pointer-events-none [&_svg]:size-6 [&_svg]:shrink-0',
    ];

    $classes = $variantClasses[$variant] ?? $variantClasses['icon'];
@endphp

<{{ $as }}
    data-slot="empty-media"
    data-variant="{{ array_key_exists($variant, $variantClasses) ? $variant : 'icon' }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
