@props([
    'side' => 'end',
    'showCloseButton' => true,
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'end';
    $showClose = filter_var($showCloseButton, FILTER_VALIDATE_BOOL);
    $composed = filled($title) || filled($description) || isset($footer);

    $sideClasses = [
        'top' => 'inset-x-0 top-0 h-auto border-b',
        'bottom' => 'inset-x-0 bottom-0 h-auto border-t',
        'start' => 'inset-y-0 start-0 h-full w-3/4 border-e sm:max-w-sm',
        'end' => 'inset-y-0 end-0 h-full w-3/4 border-s sm:max-w-sm',
    ];

    $fromClass = match ($resolvedSide) {
        'top' => 'slate-slide-from-top',
        'bottom' => 'slate-slide-from-bottom',
        'start' => 'slate-slide-from-start',
        'end' => 'slate-slide-from-end',
    };

    $panelClasses = trim('fixed z-[51] flex flex-col gap-4 bg-background shadow-lg '.$sideClasses[$resolvedSide]);
@endphp

<template x-teleport="body">
    <div data-slot="sheet-portal" class="relative z-50">
        <div
            data-slot="sheet-overlay"
            x-show="open"
            x-cloak
            x-transition:enter="slate-motion-fade"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="slate-motion-fade-out"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="open = false"
            class="fixed inset-0 z-50 bg-black/50"
        ></div>

        <{{ $as }}
            data-slot="sheet-content"
            role="dialog"
            aria-modal="true"
            tabindex="-1"
            x-show="open"
            x-cloak
            x-bind:data-state="open ? 'open' : 'closed'"
            @include('slate::components.partials.focus-trap-attrs')
            x-transition:enter="slate-motion-slide"
            x-transition:enter-start="{{ $fromClass }}"
            x-transition:enter-end="slate-slide-to"
            x-transition:leave="slate-motion-slide-out"
            x-transition:leave-start="slate-slide-to"
            x-transition:leave-end="{{ $fromClass }}"
            @click.stop
            {{ $attributes->merge(['class' => $panelClasses]) }}
        >
            @if($composed)
                <x-slate::sheet-header>
                    @if(filled($title))
                        <x-slate::sheet-title>{{ $title }}</x-slate::sheet-title>
                    @endif
                    @if(filled($description))
                        <x-slate::sheet-description>{{ $description }}</x-slate::sheet-description>
                    @endif
                </x-slate::sheet-header>

                <div class="flex-1 px-4">{{ $slot }}</div>

                @isset($footer)
                    <x-slate::sheet-footer>{{ $footer }}</x-slate::sheet-footer>
                @endisset
            @else
                {{ $slot }}
            @endif

            @if($showClose)
                <button
                    type="button"
                    data-slot="sheet-close"
                    @click="open = false"
                    class="absolute end-4 top-4 rounded-xs opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:ring-2 focus:ring-ring focus:ring-offset-2 focus:outline-hidden"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-4" aria-hidden="true">
                        <path d="M18 6 6 18" stroke-linecap="round" />
                        <path d="m6 6 12 12" stroke-linecap="round" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            @endif
        </{{ $as }}>
    </div>
</template>
