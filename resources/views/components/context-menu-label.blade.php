{{-- context-menu-label.blade.php --}}
@props([
    'inset' => false,
])

@php
    $baseClasses = 'px-2 py-1.5 text-sm font-semibold';
    $insetClasses = $inset ? 'pl-8' : '';
@endphp

<div
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $insetClasses)]) }}
>
    {{ $slot }}
</div>

