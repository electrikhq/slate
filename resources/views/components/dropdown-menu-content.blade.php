@props([
    'side' => 'bottom',
    'align' => 'start',
    'as' => 'div',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'bottom';
    $resolvedAlign = in_array($align, ['start', 'center', 'end'], true) ? $align : 'start';

    $sideClasses = [
        'top' => 'bottom-full mb-1',
        'bottom' => 'top-full mt-1',
        'start' => 'end-full top-0 me-1',
        'end' => 'start-full top-0 ms-1',
    ];

    $alignClasses = [
        'top' => ['start' => 'start-0', 'center' => 'start-1/2 -translate-x-1/2', 'end' => 'end-0'],
        'bottom' => ['start' => 'start-0', 'center' => 'start-1/2 -translate-x-1/2', 'end' => 'end-0'],
        'start' => ['start' => 'top-0', 'center' => 'top-1/2 -translate-y-1/2', 'end' => 'bottom-0'],
        'end' => ['start' => 'top-0', 'center' => 'top-1/2 -translate-y-1/2', 'end' => 'bottom-0'],
    ];

    $classes = trim(implode(' ', [
        'absolute z-50 min-w-32 overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md',
        $sideClasses[$resolvedSide],
        $alignClasses[$resolvedSide][$resolvedAlign],
    ]));
@endphp

<{{ $as }}
    data-slot="dropdown-menu-content"
    role="menu"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.100ms
    @click.stop
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
