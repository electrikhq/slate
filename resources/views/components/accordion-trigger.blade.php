@props([
    'as' => 'button',
    'type' => 'button',
])

<{{ $as }}
    data-slot="accordion-trigger"
    @if($as === 'button') type="{{ $type }}" @endif
    x-bind:aria-expanded="isOpen($el.closest('[data-slot=accordion-item]')?.dataset.value) ? 'true' : 'false'"
    x-bind:data-state="isOpen($el.closest('[data-slot=accordion-item]')?.dataset.value) ? 'open' : 'closed'"
    @click="toggle($el.closest('[data-slot=accordion-item]')?.dataset.value)"
    {{ $attributes->merge(['class' => 'flex flex-1 w-full items-start justify-between gap-4 rounded-md py-4 text-start text-sm font-medium outline-none transition-all hover:underline focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50']) }}
>
    {{ $slot }}
    <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        class="pointer-events-none size-4 shrink-0 translate-y-0.5 text-muted-foreground transition-transform duration-200 ease-out motion-reduce:transition-none group-data-[state=open]/accordion-item:rotate-180"
        aria-hidden="true"
    >
        <path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</{{ $as }}>
