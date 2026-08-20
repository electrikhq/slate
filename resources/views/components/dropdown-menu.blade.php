@props([
    'open' => false,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="dropdown-menu"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    @keydown.escape.window="if (open) open = false"
    @click.outside="open = false"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
