@props([
    'index' => 0,
    'as' => 'div',
])

@php
    $handleIndex = (int) $index;
@endphp

<{{ $as }}
    data-slot="resizable-handle"
    role="separator"
    tabindex="0"
    x-bind:aria-orientation="orientation === 'vertical' ? 'vertical' : 'horizontal'"
    x-bind:data-orientation="orientation"
    @pointerdown.prevent="startDrag({{ $handleIndex }}, $event)"
    {{ $attributes->merge(['class' => 'relative z-10 flex w-px shrink-0 items-center justify-center bg-border after:absolute after:inset-y-0 after:start-1/2 after:w-3 after:-translate-x-1/2 focus-visible:outline-hidden focus-visible:ring-1 focus-visible:ring-ring data-[orientation=vertical]:h-px data-[orientation=vertical]:w-full data-[orientation=vertical]:after:inset-x-0 data-[orientation=vertical]:after:start-0 data-[orientation=vertical]:after:top-1/2 data-[orientation=vertical]:after:h-3 data-[orientation=vertical]:after:w-full data-[orientation=vertical]:after:-translate-y-1/2 data-[orientation=vertical]:after:translate-x-0 cursor-col-resize data-[orientation=vertical]:cursor-row-resize']) }}
>
    <div class="z-10 flex h-4 w-3 items-center justify-center rounded-xs border bg-border">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-2.5" aria-hidden="true">
            <path d="M12 5v14M5 12h14" stroke-linecap="round" />
        </svg>
    </div>
</{{ $as }}>
