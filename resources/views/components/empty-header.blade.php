@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="empty-header"
    {{ $attributes->merge(['class' => 'flex max-w-sm flex-col items-center gap-2']) }}
>
    {{ $slot }}
</{{ $as }}>
