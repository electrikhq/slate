@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-content"
    {{ $attributes->merge(['class' => 'px-[var(--card-spacing)]']) }}
>
    {{ $slot }}
</{{ $as }}>
