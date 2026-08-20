@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-title"
    {{ $attributes->merge(['class' => 'font-semibold leading-none']) }}
>
    {{ $slot }}
</{{ $as }}>
