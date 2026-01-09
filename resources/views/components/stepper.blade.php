{{-- stepper.blade.php --}}
@props([
    'current' => 0,
    'orientation' => 'horizontal', // horizontal, vertical
])

@php
    $orientationClass = $orientation === 'vertical' ? 'flex-col' : 'flex-row';
@endphp

<div
    x-data="{
        current: {{ $current }},
        total: 0,
        setCurrent(index) {
            this.current = index;
        },
        init() {
            this.total = this.$el.querySelectorAll('[data-step]').length;
        }
    }"
    {{ $attributes->merge(['class' => "flex {$orientationClass} w-full"]) }}
>
    {{ $slot }}
</div>

