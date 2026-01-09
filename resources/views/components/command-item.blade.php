{{-- command-item.blade.php --}}
@props([
    'value' => null,
    'disabled' => false,
])

@php
    $itemValue = $value ?? uniqid();
    $baseClasses = 'relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none aria-selected:bg-accent aria-selected:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50';
    $disabledClasses = $disabled ? 'pointer-events-none opacity-50' : '';
@endphp

<div
    role="option"
    data-value="{{ $itemValue }}"
    @if($disabled) data-disabled="true" @endif
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $disabledClasses)]) }}
>
    {{ $slot }}
</div>

