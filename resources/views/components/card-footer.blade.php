@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-footer"
    {{ $attributes->merge(['class' => 'flex items-center rounded-b-xl border-t bg-muted/50 p-[var(--card-spacing)]']) }}
>
    {{ $slot }}
</{{ $as }}>
