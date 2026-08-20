@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="dialog-header"
    {{ $attributes->merge(['class' => 'flex flex-col gap-2 text-center sm:text-start']) }}
>
    {{ $slot }}
</{{ $as }}>
