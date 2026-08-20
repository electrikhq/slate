@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="tooltip-trigger"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
