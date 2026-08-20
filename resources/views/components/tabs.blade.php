@props([
    'orientation' => 'horizontal',
    'defaultValue' => null,
    'value' => null,
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';

    $initial = $value ?? $defaultValue ?? '';

    $classes = 'group/tabs flex gap-2 data-[orientation=horizontal]:flex-col';
@endphp

<{{ $as }}
    data-slot="tabs"
    data-orientation="{{ $resolvedOrientation }}"
    x-data="{ active: @js((string) $initial) }"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
