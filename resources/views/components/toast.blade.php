{{-- toast.blade.php --}}
@props([
    'title' => null,
    'description' => null,
    'variant' => 'default', // default, success, error, warning, info
    'action' => null,
])

@php
    $variantClasses = [
        'default' => 'bg-background text-foreground border-border',
        'success' => 'bg-success/10 text-success border-success/20',
        'error' => 'bg-error/10 text-error border-error/20',
        'warning' => 'bg-warning/10 text-warning border-warning/20',
        'info' => 'bg-info/10 text-info border-info/20',
    ];
    
    $variantClass = $variantClasses[$variant] ?? $variantClasses['default'];
@endphp

<div
    x-data="{
        show: true,
        close() {
            this.show = false;
            setTimeout(() => {
                $dispatch('close');
            }, 200);
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
    x-transition:leave-end="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
    @close.window="if ($event.detail === $el.dataset.toastId) close()"
    data-toast-id="{{ $attributes->get('id', 'toast-' . uniqid()) }}"
    role="alert"
    class="pointer-events-auto relative flex w-full items-center justify-between space-x-4 overflow-hidden rounded-md border p-6 pr-8 shadow-lg {{ $variantClass }}"
    {{ $attributes->except(['id']) }}
>
    <div class="grid gap-1 flex-1">
        @if($title)
            <div class="text-sm font-semibold">{{ $title }}</div>
        @endif
        @if($description)
            <div class="text-sm opacity-90">{{ $description }}</div>
        @endif
        {{ $slot }}
    </div>
    
    @if($action)
        <div class="flex items-center gap-2">
            {{ $action }}
        </div>
    @endif
    
    <button
        type="button"
        @click="close()"
        class="absolute right-2 top-2 rounded-md p-1 text-foreground/50 opacity-0 transition-opacity hover:text-foreground focus:opacity-100 focus:outline-none focus:ring-2 group-hover:opacity-100"
        aria-label="Close"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="12"
            height="12"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M18 6L6 18M6 6l12 12" />
        </svg>
    </button>
</div>

