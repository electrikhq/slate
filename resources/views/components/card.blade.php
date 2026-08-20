@props([
    'size' => 'default',
    'as' => 'div',
])

@php
    $resolvedSize = in_array($size, ['default', 'sm'], true) ? $size : 'default';

    // Default spacing: 1.5rem (size=sm uses 0.75rem).
    $classes = trim(implode(' ', [
        'group/card flex flex-col gap-[var(--card-spacing)] rounded-xl border bg-card py-[var(--card-spacing)] text-card-foreground shadow-none',
        $resolvedSize === 'sm' ? '[--card-spacing:0.75rem]' : '[--card-spacing:1.5rem]',
        'has-data-[slot=card-footer]:pb-0',
        'has-[>img:first-child]:pt-0',
        '[&>img:first-child]:rounded-t-xl [&>img:last-child]:rounded-b-xl',
    ]));
@endphp

<{{ $as }}
    data-slot="card"
    data-size="{{ $resolvedSize }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
