@props([
    'as' => 'a',
])

<{{ $as }}
    data-slot="breadcrumb-link"
    {{ $attributes->merge(['class' => 'transition-colors hover:text-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
