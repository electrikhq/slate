@props([
    'id' => null,
    'as' => 'li',
])

@php
    $itemId = $id ?? 'nav-item-'.uniqid();
@endphp

<{{ $as }}
    data-slot="navigation-menu-item"
    data-nav-id="{{ $itemId }}"
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</{{ $as }}>
