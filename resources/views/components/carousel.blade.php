@props([
    'orientation' => 'horizontal',
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';
@endphp

<{{ $as }}
    data-slot="carousel"
    data-orientation="{{ $resolvedOrientation }}"
    x-data="{
        index: 0,
        count: 0,
        init() {
            this.count = this.$refs.track?.children.length ?? 0;
        },
        prev() { this.index = Math.max(0, this.index - 1); },
        next() { this.index = Math.min(this.count - 1, this.index + 1); },
        goTo(i) { this.index = Math.max(0, Math.min(this.count - 1, i)); }
    }"
    {{ $attributes->merge(['class' => 'relative w-full']) }}
>
    {{ $slot }}
</{{ $as }}>
