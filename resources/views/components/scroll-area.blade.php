{{-- scroll-area.blade.php --}}
@props([
    'orientation' => 'vertical', // 'vertical' or 'horizontal' or 'both'
])

@php
    $orientationClasses = [
        'vertical' => 'overflow-y-auto',
        'horizontal' => 'overflow-x-auto',
        'both' => 'overflow-auto',
    ];
    $overflowClass = $orientationClasses[$orientation] ?? $orientationClasses['vertical'];
@endphp

<div
    {{ $attributes->merge([
        'class' => 'relative ' . $overflowClass . ' scroll-area'
    ]) }}
>
    {{ $slot }}
</div>

