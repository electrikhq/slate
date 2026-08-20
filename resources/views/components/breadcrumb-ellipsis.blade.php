@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="breadcrumb-ellipsis"
    role="presentation"
    aria-hidden="true"
    {{ $attributes->merge(['class' => 'flex size-9 items-center justify-center']) }}
>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="size-4">
            <circle cx="5" cy="12" r="1.5" />
            <circle cx="12" cy="12" r="1.5" />
            <circle cx="19" cy="12" r="1.5" />
        </svg>
        <span class="sr-only">More</span>
    @endif
</{{ $as }}>
