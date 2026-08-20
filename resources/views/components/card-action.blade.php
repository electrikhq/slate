@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-action"
    {{ $attributes->merge(['class' => 'col-start-2 row-span-2 row-start-1 self-start justify-self-end']) }}
>
    {{ $slot }}
</{{ $as }}>
