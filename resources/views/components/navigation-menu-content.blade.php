{{-- navigation-menu-content.blade.php --}}
@props([
    'value' => null,
])

@php
    $itemId = $value ?? 'item-' . uniqid();
@endphp

<div
    x-show="activeItem === '{{ $itemId }}'"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-1"
    @mouseenter="setActive('{{ $itemId }}')"
    @mouseleave="clearActive()"
    class="absolute left-0 top-full z-50 w-auto min-w-[200px]"
    data-state="open"
>
    <div class="mt-1.5 rounded-md border border-border bg-popover text-popover-foreground shadow-lg">
        {{ $slot }}
    </div>
</div>

