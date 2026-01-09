{{-- navigation-menu-item.blade.php --}}
@props([
    'value' => null,
])

@php
    $itemId = $value ?? 'item-' . uniqid();
@endphp

<li
    @mouseenter="setActive('{{ $itemId }}')"
    @mouseleave="clearActive()"
    {{ $attributes->merge(['class' => 'group relative']) }}
>
    {{ $slot }}
</li>

