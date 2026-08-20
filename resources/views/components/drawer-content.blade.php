@props([
    'side' => 'bottom',
    'showCloseButton' => true,
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $resolvedSide = in_array($side, ['top', 'bottom', 'start', 'end'], true) ? $side : 'bottom';
    $showClose = filter_var($showCloseButton, FILTER_VALIDATE_BOOL);
    $composed = filled($title) || filled($description) || isset($footer);

    $sideClasses = [
        'top' => 'inset-x-0 top-0 h-auto max-h-[85vh] rounded-b-xl border-b',
        'bottom' => 'inset-x-0 bottom-0 h-auto max-h-[85vh] rounded-t-xl border-t',
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
    <div data-slot="drawer-portal" class="relative z-50">
        <div
            data-slot="drawer-overlay"
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
            data-slot="drawer-content"
            role="dialog"
            aria-modal="true"
            tabindex="-1"
            x-show="open"
            x-cloak
            x-bind:data-state="open ? 'open' : 'closed'"
            x-effect="if (open) { $nextTick(() => $el.focus({ preventScroll: true })) }"
            @keydown.tab="
                const nodes = [...$el.querySelectorAll('a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex=\'-1\'])')].filter((el) => el.offsetParent !== null);
                if (!nodes.length) { $event.preventDefault(); return; }
                const first = nodes[0];
                const last = nodes[nodes.length - 1];
                if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus(); }
                else if (!$event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus(); }
            "
            x-transition:enter="slate-motion-slide"
            x-transition:enter-start="{{ $fromClass }}"
            x-transition:enter-end="slate-slide-to"
            x-transition:leave="slate-motion-slide-out"
            x-transition:leave-start="slate-slide-to"
            x-transition:leave-end="{{ $fromClass }}"
            @click.stop
            {{ $attributes->merge(['class' => $panelClasses]) }}
        >
            @if($resolvedSide === 'bottom' || $resolvedSide === 'top')
                <div class="mx-auto mt-2 h-1.5 w-12 shrink-0 rounded-full bg-muted" aria-hidden="true"></div>
            @endif

            @if($composed)
                <div data-slot="drawer-header" class="flex flex-col gap-1.5 p-4 text-center sm:text-start">
                    @if(filled($title))
                        <h2 data-slot="drawer-title" class="text-foreground font-semibold">{{ $title }}</h2>
                    @endif
                    @if(filled($description))
                        <p data-slot="drawer-description" class="text-sm text-muted-foreground">{{ $description }}</p>
                    @endif
                </div>

                <div class="flex-1 overflow-y-auto px-4 pb-4">{{ $slot }}</div>

                @isset($footer)
                    <div data-slot="drawer-footer" class="mt-auto flex flex-col gap-2 p-4">{{ $footer }}</div>
                @endisset
            @else
                {{ $slot }}
            @endif

            @if($showClose)
                <button
                    type="button"
                    data-slot="drawer-close"
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
