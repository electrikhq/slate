{{-- drawer-overlay.blade.php --}}
<div
    x-show="open"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"
    @click="close()"
    aria-hidden="true"
></div>

