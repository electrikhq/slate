@props([
    'side' => 'top',
    'as' => 'span',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'top';

    $sideClasses = [
        'top' => 'bottom-full start-1/2 mb-2 -translate-x-1/2',
        'bottom' => 'top-full start-1/2 mt-2 -translate-x-1/2',
        'start' => 'end-full top-1/2 me-2 -translate-y-1/2',
        'end' => 'start-full top-1/2 ms-2 -translate-y-1/2',
    ];
@endphp

<{{ $as }}
    data-slot="tooltip-content"
    role="tooltip"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.150ms
    {{ $attributes->merge(['class' => trim('pointer-events-none absolute z-50 w-max max-w-xs rounded-md bg-foreground px-3 py-1.5 text-xs text-background '.$sideClasses[$resolvedSide])]) }}
>
    {{ $slot }}
</{{ $as }}>
