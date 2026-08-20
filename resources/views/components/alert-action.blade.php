@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-action"
    {{ $attributes->merge(['class' => 'absolute end-3 top-3']) }}
>
    {{ $slot }}
</{{ $as }}>
