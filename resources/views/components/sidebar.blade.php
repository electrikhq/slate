@props([
    'side' => 'start',
    'variant' => 'sidebar',
    'as' => 'aside',
])

@php
    $resolvedSide = in_array($side, ['start', 'end'], true) ? $side : 'start';
    $isEnd = $resolvedSide === 'end';
@endphp

{{-- Positioned within sidebar-provider (relative), not the viewport. --}}
<div
    data-slot="sidebar-gap"
    data-side="{{ $resolvedSide }}"
    class="grid shrink-0 transition-[grid-template-columns] duration-300 ease-[cubic-bezier(0.32,0.72,0,1)] motion-reduce:transition-none {{ $isEnd ? 'order-last' : '' }}"
    x-bind:style="open ? 'grid-template-columns: 1fr' : 'grid-template-columns: 0fr'"
>
    <div class="min-w-0 overflow-hidden">
        <{{ $as }}
            data-slot="sidebar"
            data-side="{{ $resolvedSide }}"
            data-variant="{{ $variant }}"
            x-bind:data-state="open ? 'open' : 'closed'"
            {{ $attributes->merge(['class' => trim('flex h-full w-64 flex-col border-e border-sidebar-border bg-sidebar text-sidebar-foreground '.($isEnd ? 'border-s border-e-0' : ''))]) }}
        >
            {{ $slot }}
        </{{ $as }}>
    </div>
</div>
