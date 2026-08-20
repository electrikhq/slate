@props(['as' => 'p'])

<{{ $as }}
    data-slot="sheet-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
