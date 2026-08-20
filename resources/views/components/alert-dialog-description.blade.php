@props(['as' => 'p'])

<{{ $as }}
    data-slot="alert-dialog-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
