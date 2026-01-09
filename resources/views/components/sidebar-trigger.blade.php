{{-- sidebar-trigger.blade.php --}}
<button
    type="button"
    x-data="{
        toggle() {
            this.$dispatch('toggle-sidebar');
        }
    }"
    @click="toggle()"
    class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-border bg-background text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
    aria-label="Toggle sidebar"
    {{ $attributes }}
>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
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
        >
            <path d="M3 9h18M3 15h18" />
        </svg>
    @endif
</button>

