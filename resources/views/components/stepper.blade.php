@props([
    'current' => 1,
    'value' => null,
    'orientation' => 'horizontal',
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';

    $initial = (int) ($value ?? $current);

    $classes = trim(implode(' ', [
        'flex',
        $resolvedOrientation === 'vertical' ? 'flex-col gap-4' : 'items-start gap-4',
    ]));
@endphp

<{{ $as }}
    data-slot="stepper"
    data-orientation="{{ $resolvedOrientation }}"
    x-data="{ current: {{ max(1, $initial) }} }"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
