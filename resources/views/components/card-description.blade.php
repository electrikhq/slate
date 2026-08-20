@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
