@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="drawer-close"
    @click="open = false"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
