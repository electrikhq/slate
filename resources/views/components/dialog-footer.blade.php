@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="dialog-footer"
    {{ $attributes->merge(['class' => 'flex flex-col-reverse gap-2 sm:flex-row sm:justify-end']) }}
>
    {{ $slot }}
</{{ $as }}>
