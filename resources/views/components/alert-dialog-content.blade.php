{{-- alert-dialog-content.blade.php --}}
@props([
    'size' => 'md', // sm | md | lg | xl
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
    ];
@endphp

<div
    x-show="open"
    x-cloak
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    @click.stop
    role="alertdialog"
    aria-modal="true"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
>
    <div
        @click.stop
        class="relative w-full {{ $sizes[$size] ?? $sizes['md'] }} rounded-lg border border-border bg-background text-foreground shadow-lg ring-offset-background p-6"
    >
        {{ $slot }}
    </div>
</div>

