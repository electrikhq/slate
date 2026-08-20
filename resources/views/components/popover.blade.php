@props([
    'open' => false,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
    $composed = isset($content);
@endphp

<{{ $as }}
    data-slot="popover"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    @keydown.escape.window="if (open) open = false"
    @click.outside="open = false"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
>
    @if($composed)
        <span data-slot="popover-trigger" class="inline-flex" @click="open = !open">
            {{ $slot }}
        </span>

        <div
            data-slot="popover-content"
            role="dialog"
            x-show="open"
            x-cloak
            x-transition.opacity.duration.150ms
            @click.stop
            class="absolute start-1/2 top-full z-50 mt-2 w-72 -translate-x-1/2 rounded-md border bg-popover p-4 text-popover-foreground shadow-md outline-none"
        >
            {{ $content }}
        </div>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
