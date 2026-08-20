@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="menubar"
    x-data="{ activeMenu: null }"
    {{ $attributes->merge(['class' => 'flex h-9 items-center gap-1 rounded-md border bg-background p-1 shadow-xs']) }}
>
    {{ $slot }}
</{{ $as }}>
