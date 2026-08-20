@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="empty-title"
    {{ $attributes->merge(['class' => 'text-lg font-medium tracking-tight']) }}
>
    {{ $slot }}
</{{ $as }}>
