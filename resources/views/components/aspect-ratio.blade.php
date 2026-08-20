@props([
    'ratio' => '16 / 9',
    'as' => 'div',
])

@php
    $presets = [
        '1' => '1 / 1',
        '1:1' => '1 / 1',
        'square' => '1 / 1',
        '16:9' => '16 / 9',
        'video' => '16 / 9',
        '4:3' => '4 / 3',
        '3:2' => '3 / 2',
        '21:9' => '21 / 9',
    ];

    $resolvedRatio = $presets[$ratio] ?? $ratio;
@endphp

<{{ $as }}
    data-slot="aspect-ratio"
    style="aspect-ratio: {{ $resolvedRatio }};"
    {{ $attributes->merge(['class' => 'relative w-full']) }}
>
    {{ $slot }}
</{{ $as }}>
