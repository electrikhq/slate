@props([
    'label' => null,
    'side' => 'top',
    'open' => false,
    'as' => 'div',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'top';
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);

    $sideClasses = [
        'top' => 'bottom-full start-1/2 mb-2 -translate-x-1/2',
        'bottom' => 'top-full start-1/2 mt-2 -translate-x-1/2',
        'start' => 'end-full top-1/2 me-2 -translate-y-1/2',
        'end' => 'start-full top-1/2 ms-2 -translate-y-1/2',
    ];

    // Named slot `content` becomes $content; `label` is the progressive prop.
    $composed = filled($label) || isset($content);
@endphp

<{{ $as }}
    data-slot="tooltip"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    @mouseenter="open = true"
    @mouseleave="open = false"
    @focusin="open = true"
    @focusout="open = false"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
>
    @if($composed)
        <span data-slot="tooltip-trigger" class="inline-flex">
            {{ $slot }}
        </span>

        <span
            data-slot="tooltip-content"
            role="tooltip"
            x-show="open"
            x-cloak
            x-transition.opacity.duration.150ms
            @class([
                // w-max (not w-fit): abspos + start-1/2 otherwise shrink-wraps to the trigger width
                'pointer-events-none absolute z-50 w-max max-w-xs rounded-md bg-foreground px-3 py-1.5 text-xs text-background',
                $sideClasses[$resolvedSide],
            ])
        >
            {{ $content ?? $label }}
        </span>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
