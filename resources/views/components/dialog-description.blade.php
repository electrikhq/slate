@props([
    'as' => 'p',
])

<{{ $as }}
    data-slot="dialog-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
