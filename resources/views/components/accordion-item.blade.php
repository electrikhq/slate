{{-- accordion-item.blade.php --}}
@props([
    'value' => null, // Unique identifier for this item
])

@php
    // Generate unique value if not provided
    $itemValue = $value ?? 'item-' . uniqid();
@endphp

<div
    x-data="{ itemValue: '{{ $itemValue }}' }"
    data-accordion-item="{{ $itemValue }}"
    {{ $attributes->merge(['class' => 'border-b border-border']) }}
>
    {{ $slot }}
</div>

