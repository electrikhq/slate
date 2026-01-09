{{-- spotlight-content.blade.php --}}
@props([
    'placeholder' => 'Search...',
    'shortcut' => '⌘K',
])

<div
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    @keydown.window.escape="close()"
    class="fixed left-1/2 top-1/4 z-50 w-full max-w-lg -translate-x-1/2 -translate-y-1/2"
    role="dialog"
    aria-modal="true"
    {{ $attributes }}
>
    <div class="overflow-hidden rounded-lg border border-border bg-popover text-popover-foreground shadow-lg">
        <div class="flex items-center border-b border-border px-3">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="mr-2 h-4 w-4 shrink-0 opacity-50"
            >
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.35-4.35" />
            </svg>
            <input
                x-ref="input"
                type="text"
                x-model="search"
                @keydown="handleKeydown($event)"
                placeholder="{{ $placeholder }}"
                class="flex h-12 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50"
            />
            <kbd class="pointer-events-none inline-flex h-5 select-none items-center gap-1 rounded border bg-muted px-1.5 font-mono text-[10px] font-medium text-muted-foreground opacity-100">
                {{ $shortcut }}
            </kbd>
        </div>
        <div class="max-h-[300px] overflow-y-auto p-1">
            {{ $slot }}
        </div>
    </div>
</div>

