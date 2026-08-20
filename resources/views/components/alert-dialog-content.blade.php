@props([
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $composed = filled($title) || filled($description) || isset($footer);
    $panelClasses = 'fixed top-1/2 left-1/2 z-[51] grid w-full max-w-[calc(100%-2rem)] -translate-x-1/2 -translate-y-1/2 gap-4 rounded-lg border bg-background p-6 shadow-lg outline-none sm:max-w-lg';
@endphp

<template x-teleport="body">
    <div
        data-slot="alert-dialog-portal"
        x-show="open"
        x-cloak
        class="relative z-50"
    >
        <div
            data-slot="alert-dialog-overlay"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/50"
        ></div>

        <{{ $as }}
            data-slot="alert-dialog-content"
            role="alertdialog"
            aria-modal="true"
            tabindex="-1"
            x-effect="
                if (open) {
                    if (!$el._slatePrevFocus) $el._slatePrevFocus = document.activeElement;
                    $nextTick(() => $el.focus({ preventScroll: true }));
                } else if ($el._slatePrevFocus) {
                    const prev = $el._slatePrevFocus;
                    $el._slatePrevFocus = null;
                    $nextTick(() => prev?.focus?.({ preventScroll: true }));
                }
            "
            @keydown.tab="
                const nodes = [...$el.querySelectorAll('a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex=\'-1\'])')].filter((el) => el.getClientRects().length > 0);
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
                <x-slate::alert-dialog-header>
                    @if(filled($title))
                        <x-slate::alert-dialog-title>{{ $title }}</x-slate::alert-dialog-title>
                    @endif
                    @if(filled($description))
                        <x-slate::alert-dialog-description>{{ $description }}</x-slate::alert-dialog-description>
                    @endif
                </x-slate::alert-dialog-header>

                {{ $slot }}

                @isset($footer)
                    <x-slate::alert-dialog-footer>{{ $footer }}</x-slate::alert-dialog-footer>
                @endisset
            @else
                {{ $slot }}
            @endif
        </{{ $as }}>
    </div>
</template>
