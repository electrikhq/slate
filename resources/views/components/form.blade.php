@props([
    'as' => 'form',
])

<{{ $as }}
    data-slot="form"
    {{ $attributes->merge(['class' => 'grid w-full gap-6']) }}
>
    {{ $slot }}
</{{ $as }}>
