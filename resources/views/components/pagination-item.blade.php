@props([
    'as' => 'li',
])

<{{ $as }}
    data-slot="pagination-item"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
