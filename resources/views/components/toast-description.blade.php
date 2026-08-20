@props(['as' => 'div'])

<{{ $as }}
    data-slot="toast-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
