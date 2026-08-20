@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-description"
    {{ $attributes->merge(['class' => 'col-start-2 grid justify-items-start gap-1 text-sm text-muted-foreground [&_p]:leading-relaxed']) }}
>
    {{ $slot }}
</{{ $as }}>
