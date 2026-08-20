@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="popover-trigger"
    @click="open = !open"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
