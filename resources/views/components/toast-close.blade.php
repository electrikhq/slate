@props([
    'as' => 'button',
])

<{{ $as }}
    type="button"
    data-slot="toast-close"
    @click="typeof dismiss === 'function' ? dismiss(typeof toast !== 'undefined' ? toast.id : id) : $el.closest('[data-slot=toast]')?.remove()"
    {{ $attributes->merge(['class' => 'absolute end-2 top-2 rounded-md p-1 text-foreground/50 opacity-70 transition-opacity hover:text-foreground hover:opacity-100 focus-visible:opacity-100 focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring']) }}
>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4" aria-hidden="true">
        <path d="M18 6 6 18" stroke-linecap="round" />
        <path d="m6 6 12 12" stroke-linecap="round" />
    </svg>
    <span class="sr-only">Dismiss</span>
</{{ $as }}>
