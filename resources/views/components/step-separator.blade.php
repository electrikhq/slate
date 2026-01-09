{{-- step-separator.blade.php --}}
@props([
    'orientation' => 'horizontal', // horizontal, vertical
])

@php
    $separatorClass = $orientation === 'vertical' 
        ? 'ml-5 h-full w-px' 
        : 'mx-4 h-px flex-1';
@endphp

<div
    {{ $attributes->merge([
        'class' => "bg-border {$separatorClass}"
    ]) }}
></div>

