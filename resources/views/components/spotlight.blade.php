@props([
    'size' => 600,
    'color' => 'rgba(120, 119, 198, 0.15)',
    'as' => 'div',
])

@php
    $spotSize = max(100, (int) $size);
@endphp

<{{ $as }}
    data-slot="spotlight"
    x-data="{
        x: 50,
        y: 50,
        move(e) {
            const rect = $el.getBoundingClientRect();
            this.x = ((e.clientX - rect.left) / rect.width) * 100;
            this.y = ((e.clientY - rect.top) / rect.height) * 100;
        }
    }"
    @mousemove="move($event)"
    x-bind:style="`background: radial-gradient({{ $spotSize }}px circle at ${x}% ${y}%, {{ $color }}, transparent 80%);`"
    {{ $attributes->merge(['class' => 'relative overflow-hidden']) }}
>
    {{ $slot }}
</{{ $as }}>
