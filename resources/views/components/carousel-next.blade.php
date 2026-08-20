@props(['as' => 'button'])

<{{ $as }}
    type="button"
    data-slot="carousel-next"
    @click="next()"
    x-bind:disabled="index >= count - 1"
    {{ $attributes->merge(['class' => 'absolute end-2 top-1/2 z-10 inline-flex size-8 -translate-y-1/2 items-center justify-center rounded-full border bg-background shadow-sm transition-opacity hover:bg-accent disabled:pointer-events-none disabled:opacity-50']) }}
>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4 rtl:rotate-180" aria-hidden="true">
        <path d="m9 18 6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <span class="sr-only">Next slide</span>
</{{ $as }}>
