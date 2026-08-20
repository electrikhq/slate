@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="form-item"
    {{ $attributes->merge(['class' => 'grid gap-2']) }}
>
    {{ $slot }}
</{{ $as }}>
