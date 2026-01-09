{{-- calendar-nav.blade.php --}}
@props([
    'previous' => true,
    'next' => true,
])

<div
    {{ $attributes->merge([
        'class' => 'flex items-center gap-1'
    ]) }}
>
    @if($previous)
        <button
            type="button"
            @click="previousMonth()"
            class="inline-flex items-center justify-center rounded-md p-1 hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
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
                <path d="m15 18-6-6 6-6" />
            </svg>
        </button>
    @endif
    
    @if($next)
        <button
            type="button"
            @click="nextMonth()"
            class="inline-flex items-center justify-center rounded-md p-1 hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
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
    @endif
</div>

