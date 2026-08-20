@props(['as' => 'p'])

<{{ $as }}
    data-slot="drawer-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
