{{-- carousel-next.blade.php --}}
@props([])

<button
    type="button"
    @click="next()"
    class="absolute right-3 top-1/2 -translate-y-1/2 z-10
           inline-flex h-10 w-10 items-center justify-center
           rounded-full border border-border bg-background/80 shadow-md
           hover:bg-background focus-visible:outline-none focus-visible:ring-2 
           focus-visible:ring-ring focus-visible:ring-offset-2 
           disabled:pointer-events-none disabled:opacity-50 transition-colors"
    aria-label="Next slide"
>
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
        class="h-4 w-4"
    >
        <path d="m9 18 6-6-6-6" />
    </svg>
</button>
