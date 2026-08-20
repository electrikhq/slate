@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="skeleton"
    aria-hidden="true"
    {{ $attributes->merge(['class' => 'animate-pulse rounded-md bg-accent']) }}
>
    {{ $slot }}
</{{ $as }}>
