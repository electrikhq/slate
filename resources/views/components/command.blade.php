@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="command"
    x-data="{ query: '' }"
    {{ $attributes->merge(['class' => 'flex h-full w-full flex-col overflow-hidden rounded-md bg-popover text-popover-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
