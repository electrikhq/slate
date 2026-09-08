@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-action"
    {{ $attributes->merge(['class' => 'col-start-3 row-start-1 self-start justify-self-end shrink-0']) }}
>
    {{ $slot }}
</{{ $as }}>
