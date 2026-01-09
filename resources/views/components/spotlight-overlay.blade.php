{{-- spotlight-overlay.blade.php --}}
<div
    x-show="open"
    x-cloak
    x-transition:enter="transition-opacity ease-linear duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="close()"
    class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm"
    aria-hidden="true"
    {{ $attributes }}
></div>

