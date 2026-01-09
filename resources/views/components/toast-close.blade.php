{{-- toast-close.blade.php --}}
<button
    type="button"
    @click="$dispatch('close')"
    class="absolute right-2 top-2 rounded-md p-1 text-foreground/50 opacity-0 transition-opacity hover:text-foreground focus:opacity-100 focus:outline-none focus:ring-2 group-hover:opacity-100"
    aria-label="Close"
    {{ $attributes }}
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

