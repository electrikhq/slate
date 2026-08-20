@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="navigation-menu-content"
    x-show="active === $el.closest('[data-nav-id]')?.getAttribute('data-nav-id')"
    x-cloak
    @mouseleave="active = null"
    x-transition.opacity.duration.150ms
    {{ $attributes->merge(['class' => 'absolute start-0 top-full z-50 mt-1.5 w-auto rounded-md border bg-popover p-4 text-popover-foreground shadow-md']) }}
>
    {{ $slot }}
</{{ $as }}>
