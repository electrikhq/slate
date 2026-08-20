@props([
    'open' => false,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="dialog"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    x-effect="document.documentElement.classList.toggle('slate-scroll-lock', open)"
    @keydown.escape.window="if (open) open = false"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
