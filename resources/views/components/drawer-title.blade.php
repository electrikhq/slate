@props(['as' => 'h2'])

<{{ $as }}
    data-slot="drawer-title"
    {{ $attributes->merge(['class' => 'text-foreground font-semibold']) }}
>
    {{ $slot }}
</{{ $as }}>
