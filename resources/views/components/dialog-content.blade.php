@props([
    'showCloseButton' => true,
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $showClose = filter_var($showCloseButton, FILTER_VALIDATE_BOOL);
    $composed = filled($title) || filled($description) || isset($footer);

    $panelClasses = 'fixed top-1/2 left-1/2 z-[51] grid w-full max-w-[calc(100%-2rem)] -translate-x-1/2 -translate-y-1/2 gap-4 rounded-lg border bg-background p-6 shadow-lg outline-none sm:max-w-lg';
@endphp

{{-- Alpine x-teleport requires a single root element. --}}
<template x-teleport="body">
    <div
        data-slot="dialog-portal"
        x-show="open"
        x-cloak
        class="relative z-50"
    >
        <div
            data-slot="dialog-overlay"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="open = false"
            class="fixed inset-0 z-50 bg-black/50"
        ></div>

        <{{ $as }}
            data-slot="dialog-content"
            role="dialog"
            aria-modal="true"
            tabindex="-1"
            x-effect="if (open) { $nextTick(() => $el.focus({ preventScroll: true })) }"
            @keydown.tab="
                const nodes = [...$el.querySelectorAll('a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex=\'-1\'])')].filter((el) => el.offsetParent !== null);
                if (!nodes.length) { $event.preventDefault(); return; }
                const first = nodes[0];
                const last = nodes[nodes.length - 1];
                if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus(); }
                else if (!$event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus(); }
            "
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            {{ $attributes->merge(['class' => $panelClasses]) }}
        >
            @if($composed)
                <x-slate::dialog-header>
                    @if(filled($title))
                        <x-slate::dialog-title>{{ $title }}</x-slate::dialog-title>
                    @endif
                    @if(filled($description))
                        <x-slate::dialog-description>{{ $description }}</x-slate::dialog-description>
                    @endif
                </x-slate::dialog-header>

                {{ $slot }}

                @isset($footer)
                    <x-slate::dialog-footer>{{ $footer }}</x-slate::dialog-footer>
                @endisset
            @else
                {{ $slot }}
            @endif

            @if($showClose)
                <button
                    type="button"
                    data-slot="dialog-close"
                    @click="open = false"
                    class="absolute end-4 top-4 rounded-xs opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:ring-2 focus:ring-ring focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M18 6 6 18" stroke-linecap="round" />
                        <path d="m6 6 12 12" stroke-linecap="round" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            @endif
        </{{ $as }}>
    </div>
</template>
