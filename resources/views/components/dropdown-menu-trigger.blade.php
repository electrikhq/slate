@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="dropdown-menu-trigger"
    @click="open = !open"
    x-bind:aria-expanded="open ? 'true' : 'false'"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
