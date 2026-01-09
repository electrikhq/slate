{{-- menubar-menu.blade.php --}}
@props([
    'value' => null,
])

@php
    $menuId = $value ?? 'menu-' . uniqid();
@endphp

<div
    class="relative"
    @mouseenter="if (openMenu) setOpen('{{ $menuId }}')"
    @mouseleave="if (openMenu === '{{ $menuId }}') closeMenu()"
>
    {{ $slot }}
</div>

