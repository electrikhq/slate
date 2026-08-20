@props([
    'as' => 'button',
    'type' => 'button',
])

<{{ $as }}
    data-slot="collapsible-trigger"
    @if($as === 'button') type="{{ $type }}" @endif
    x-bind:aria-expanded="open ? 'true' : 'false'"
    x-bind:data-state="open ? 'open' : 'closed'"
    @click="open = !open"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
