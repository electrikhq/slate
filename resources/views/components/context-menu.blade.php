@props([
    'open' => false,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="context-menu"
    x-data="{
        open: {{ $isOpen ? 'true' : 'false' }},
        x: 0,
        y: 0,
        show(event) {
            event.preventDefault();
            this.x = event.clientX;
            this.y = event.clientY;
            this.open = true;
        }
    }"
    @keydown.escape.window="if (open) open = false"
    @click.outside="open = false"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
