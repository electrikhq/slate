@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="dropdown-menu-shortcut"
    {{ $attributes->merge(['class' => 'ms-auto text-xs tracking-widest text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
