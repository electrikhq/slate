@props([
    'defaultOpen' => true,
    'as' => 'div',
])

@php
    $isOpen = filter_var($defaultOpen, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="app-shell"
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }"
    {{ $attributes->merge(['class' => 'flex h-svh max-h-svh w-full flex-col overflow-hidden']) }}
>
    @isset($header)
        <header data-slot="app-shell-header" class="z-20 flex h-14 shrink-0 items-center gap-4 border-b bg-background px-4">
            {{ $header }}
        </header>
    @endisset

    <div class="flex min-h-0 flex-1 overflow-hidden">
        @isset($primary)
            <div data-slot="app-shell-primary" class="flex h-full shrink-0 flex-col">
                {{ $primary }}
            </div>
        @endisset

        @isset($sidebar)
            <div
                data-slot="app-shell-sidebar"
                class="grid h-full shrink-0 transition-[grid-template-columns] duration-300 ease-[cubic-bezier(0.32,0.72,0,1)] motion-reduce:transition-none"
                x-bind:style="open ? 'grid-template-columns: 1fr' : 'grid-template-columns: 0fr'"
            >
                <div class="h-full min-w-0 overflow-hidden">
                    {{ $sidebar }}
                </div>
            </div>
        @endisset

        <main data-slot="app-shell-main" class="flex min-h-0 min-w-0 flex-1 flex-col overflow-y-auto">
            @isset($main)
                {{ $main }}
            @else
                {{ $slot }}
            @endisset
        </main>
    </div>
</{{ $as }}>
