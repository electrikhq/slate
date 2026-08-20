@props([
    'open' => false,
    'openDelay' => 200,
    'closeDelay' => 150,
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
    $composed = isset($content);
@endphp

<{{ $as }}
    data-slot="hover-card"
    x-data="{
        open: {{ $isOpen ? 'true' : 'false' }},
        openTimer: null,
        closeTimer: null,
        openDelay: {{ (int) $openDelay }},
        closeDelay: {{ (int) $closeDelay }},
        show() {
            clearTimeout(this.closeTimer)
            this.openTimer = setTimeout(() => { this.open = true }, this.openDelay)
        },
        hide() {
            clearTimeout(this.openTimer)
            this.closeTimer = setTimeout(() => { this.open = false }, this.closeDelay)
        }
    }"
    @mouseenter="show()"
    @mouseleave="hide()"
    @focusin="show()"
    @focusout="hide()"
    {{ $attributes->merge(['class' => 'relative inline-flex']) }}
>
    @if($composed)
        <span data-slot="hover-card-trigger" class="inline-flex">
            {{ $slot }}
        </span>

        <div
            data-slot="hover-card-content"
            role="dialog"
            x-show="open"
            x-cloak
            x-transition.opacity.duration.150ms
            @mouseenter="show()"
            @mouseleave="hide()"
            class="absolute start-1/2 top-full z-50 mt-2 w-64 -translate-x-1/2 rounded-md border bg-popover p-4 text-popover-foreground shadow-md outline-none"
        >
            {{ $content }}
        </div>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
