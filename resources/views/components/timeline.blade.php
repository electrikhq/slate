{{-- timeline.blade.php --}}
@props([
    'orientation' => 'vertical', // vertical, horizontal
])

@php
    $orientationClass = $orientation === 'horizontal' ? 'flex-row' : 'flex-col';
@endphp

<div
    {{ $attributes->merge([
        'class' => "relative flex {$orientationClass} w-full"
    ]) }}
>
    {{ $slot }}
</div>

