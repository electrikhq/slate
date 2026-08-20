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
    {{ $attributes->merge(['class' => 'flex min-h-svh w-full flex-col']) }}
>
    @isset($header)
        <header data-slot="app-shell-header" class="sticky top-0 z-20 flex h-14 shrink-0 items-center gap-4 border-b bg-background px-4">
            {{ $header }}
        </header>
    @endisset

    <div class="flex min-h-0 flex-1">
        @isset($sidebar)
            <div
                data-slot="app-shell-sidebar"
                class="grid shrink-0 transition-[grid-template-columns] duration-300 ease-[cubic-bezier(0.32,0.72,0,1)] motion-reduce:transition-none"
                x-bind:style="open ? 'grid-template-columns: 1fr' : 'grid-template-columns: 0fr'"
            >
                <div class="min-w-0 overflow-hidden">
                    {{ $sidebar }}
                </div>
            </div>
        @endisset

        <main data-slot="app-shell-main" class="flex min-w-0 flex-1 flex-col overflow-auto">
            @isset($main)
                {{ $main }}
            @else
                {{ $slot }}
            @endisset
        </main>
    </div>
</{{ $as }}>
