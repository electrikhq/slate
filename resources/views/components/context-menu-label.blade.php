@props(['as' => 'div'])

<{{ $as }}
    data-slot="context-menu-label"
    {{ $attributes->merge(['class' => 'px-2 py-1.5 text-sm font-medium text-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
