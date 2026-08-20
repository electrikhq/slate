@props([
    'side' => 'bottom',
    'align' => 'center',
    'as' => 'div',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'bottom';
    $resolvedAlign = in_array($align, ['start', 'center', 'end'], true) ? $align : 'center';

    $sideClasses = [
        'top' => 'bottom-full mb-2',
        'bottom' => 'top-full mt-2',
        'start' => 'end-full top-0 me-2',
        'end' => 'start-full top-0 ms-2',
    ];

    $alignClasses = [
        'top' => [
            'start' => 'start-0',
            'center' => 'start-1/2 -translate-x-1/2',
            'end' => 'end-0',
        ],
        'bottom' => [
            'start' => 'start-0',
            'center' => 'start-1/2 -translate-x-1/2',
            'end' => 'end-0',
        ],
        'start' => [
            'start' => 'top-0',
            'center' => 'top-1/2 -translate-y-1/2',
            'end' => 'bottom-0',
        ],
        'end' => [
            'start' => 'top-0',
            'center' => 'top-1/2 -translate-y-1/2',
            'end' => 'bottom-0',
        ],
    ];

    $classes = trim(implode(' ', [
        'absolute z-50 w-72 rounded-md border bg-popover p-4 text-popover-foreground shadow-md outline-none',
        $sideClasses[$resolvedSide],
        $alignClasses[$resolvedSide][$resolvedAlign],
    ]));
@endphp

<{{ $as }}
    data-slot="popover-content"
    role="dialog"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.150ms
    @click.stop
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
