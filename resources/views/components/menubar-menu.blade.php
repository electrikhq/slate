@props([
    'id' => null,
    'as' => 'div',
])

@php
    $menuId = $id ?? 'menubar-menu-'.uniqid();
@endphp

<{{ $as }}
    data-slot="menubar-menu"
    data-menu-id="{{ $menuId }}"
    class="relative"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
