@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="pagination-ellipsis"
    aria-hidden="true"
    {{ $attributes->merge(['class' => 'flex size-9 items-center justify-center']) }}
>
    <svg viewBox="0 0 24 24" fill="currentColor" class="size-4" aria-hidden="true">
        <circle cx="5" cy="12" r="1.5" />
        <circle cx="12" cy="12" r="1.5" />
        <circle cx="19" cy="12" r="1.5" />
    </svg>
    <span class="sr-only">More pages</span>
</{{ $as }}>
