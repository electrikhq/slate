@props([
    'open' => false,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="collapsible"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    x-bind:data-state="open ? 'open' : 'closed'"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
