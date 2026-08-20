@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="dialog-trigger"
    @click="open = true"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
