@props([
    'as' => 'h2',
])

<{{ $as }}
    data-slot="dialog-title"
    {{ $attributes->merge(['class' => 'text-lg font-semibold leading-none']) }}
>
    {{ $slot }}
</{{ $as }}>
