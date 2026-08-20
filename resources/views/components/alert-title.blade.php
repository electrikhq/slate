@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-title"
    {{ $attributes->merge(['class' => 'col-start-2 line-clamp-1 min-h-4 font-medium tracking-tight']) }}
>
    {{ $slot }}
</{{ $as }}>
