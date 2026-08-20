@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="collapsible-content"
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 -translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-1"
    x-bind:data-state="open ? 'open' : 'closed'"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
