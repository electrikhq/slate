@props([
    'as' => 'button',
])

<{{ $as }}
    type="button"
    data-slot="menubar-trigger"
    x-bind:aria-expanded="activeMenu === $el.closest('[data-menu-id]')?.getAttribute('data-menu-id') ? 'true' : 'false'"
    @click="
        const id = $el.closest('[data-menu-id]')?.getAttribute('data-menu-id');
        activeMenu = activeMenu === id ? null : id;
    "
    @mouseenter="
        if (activeMenu !== null) {
            activeMenu = $el.closest('[data-menu-id]')?.getAttribute('data-menu-id');
        }
    "
    {{ $attributes->merge(['class' => 'inline-flex items-center rounded-sm px-2 py-1 text-sm font-medium outline-hidden select-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
