@props(['as' => 'h2'])

<{{ $as }}
    data-slot="sheet-title"
    {{ $attributes->merge(['class' => 'text-foreground font-semibold']) }}
>
    {{ $slot }}
</{{ $as }}>
