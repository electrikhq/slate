@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="empty-content"
    {{ $attributes->merge(['class' => 'flex w-full max-w-sm min-w-0 flex-row flex-wrap items-center justify-center gap-2 text-sm']) }}
>
    {{ $slot }}
</{{ $as }}>
