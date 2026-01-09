{{-- separator.blade.php --}}
@props([
    'orientation' => 'horizontal', // 'horizontal' or 'vertical'
    'decorative' => true,
])

@php
    $isHorizontal = $orientation === 'horizontal';
@endphp

<div
    role="{{ $decorative ? 'none' : 'separator' }}"
    aria-orientation="{{ $orientation }}"
    {{ $attributes->merge([
        'class' => $isHorizontal 
            ? 'shrink-0 bg-border h-[1px] w-full' 
            : 'shrink-0 bg-border h-full w-[1px]'
    ]) }}
></div>
