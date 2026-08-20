@props([
    'as' => 'ul',
])

<{{ $as }}
    data-slot="pagination-content"
    {{ $attributes->merge(['class' => 'flex flex-row items-center gap-1']) }}
>
    {{ $slot }}
</{{ $as }}>
