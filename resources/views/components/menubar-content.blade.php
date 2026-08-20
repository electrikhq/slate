@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="menubar-content"
    role="menu"
    x-show="activeMenu === $el.closest('[data-menu-id]')?.getAttribute('data-menu-id')"
    x-cloak
    @click.outside="activeMenu = null"
    x-transition.opacity.duration.100ms
    {{ $attributes->merge(['class' => 'absolute start-0 top-full z-50 mt-1 min-w-32 overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md']) }}
>
    {{ $slot }}
</{{ $as }}>
