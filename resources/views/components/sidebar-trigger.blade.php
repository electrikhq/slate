@props([
    'as' => 'button',
])

<{{ $as }}
    type="button"
    data-slot="sidebar-trigger"
    @click="open = !open"
    {{ $attributes->merge(['class' => 'inline-flex size-7 items-center justify-center rounded-md border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground']) }}
>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4" aria-hidden="true">
        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" />
    </svg>
    <span class="sr-only">Toggle sidebar</span>
</{{ $as }}>
