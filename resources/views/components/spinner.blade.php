@props([
    'label' => 'Loading',
])

@php
    $classes = 'size-4 animate-spin';
@endphp

<svg
    data-slot="spinner"
    role="status"
    aria-label="{{ $label }}"
    viewBox="0 0 24 24"
    fill="none"
    {{ $attributes->merge(['class' => $classes]) }}
>
    <path
        d="M21 12a9 9 0 1 1-6.219-8.56"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
    />
</svg>
