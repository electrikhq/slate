@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="drawer-trigger"
    @click="open = true"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
