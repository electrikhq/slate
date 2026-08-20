@props([
    'as' => 'div',
])

<template x-teleport="body">
    <div
        data-slot="context-menu-portal"
        x-show="open"
        x-cloak
        class="fixed z-50"
        x-bind:style="`top: ${y}px; inset-inline-start: ${x}px;`"
    >
        <{{ $as }}
            data-slot="context-menu-content"
            role="menu"
            x-transition.opacity.duration.100ms
            @click.stop
            {{ $attributes->merge(['class' => 'min-w-32 overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md']) }}
        >
            {{ $slot }}
        </{{ $as }}>
    </div>
</template>
