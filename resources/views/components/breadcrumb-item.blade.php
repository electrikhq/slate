@props([
    'as' => 'li',
])

<{{ $as }}
    data-slot="breadcrumb-item"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5']) }}
>
    {{ $slot }}
</{{ $as }}>
