{{-- skeleton.blade.php --}}
@props([
    'variant' => 'default', // 'default', 'text', 'circular', 'rectangular'
    'width' => null,
    'height' => null,
])

@php
    $variantClasses = [
        'default' => 'rounded-md',
        'text' => 'rounded',
        'circular' => 'rounded-full',
        'rectangular' => 'rounded-none',
    ];
    
    $baseClasses = 'animate-pulse bg-muted';
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']);
    
    $style = '';
    if ($width) {
        $style .= 'width: ' . (is_numeric($width) ? $width . 'px' : $width) . '; ';
    }
    if ($height) {
        $style .= 'height: ' . (is_numeric($height) ? $height . 'px' : $height) . '; ';
    }
@endphp

<div
    {{ $attributes->merge([
        'class' => $classes
    ]) }}
    @if($style) style="{{ $style }}" @endif
>
    {{ $slot }}
</div>
