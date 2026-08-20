@props([
    'as' => 'button',
])

<{{ $as }}
    type="button"
    data-slot="navigation-menu-trigger"
    x-bind:aria-expanded="active === $el.closest('[data-nav-id]')?.getAttribute('data-nav-id') ? 'true' : 'false'"
    @mouseenter="active = $el.closest('[data-nav-id]')?.getAttribute('data-nav-id')"
    @click="
        const id = $el.closest('[data-nav-id]')?.getAttribute('data-nav-id');
        active = active === id ? null : id;
    "
    {{ $attributes->merge(['class' => 'group inline-flex h-9 w-max items-center justify-center rounded-md bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-hidden disabled:pointer-events-none disabled:opacity-50']) }}
>
    {{ $slot }}
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="relative top-px ms-1 size-3 transition duration-200 group-data-[state=open]:rotate-180" aria-hidden="true">
        <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</{{ $as }}>
