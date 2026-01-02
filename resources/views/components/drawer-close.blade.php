{{-- drawer-close.blade.php --}}
@props([
    'as' => 'button',
])

@if(empty(trim($slot ?? '')))
    {{-- Icon-only close button (X icon) --}}
    <button
        type="button"
        @click="close()"
        class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none"
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
            <path d="M18 6L6 18" />
            <path d="M6 6l12 12" />
        </svg>
        <span class="sr-only">Close</span>
    </button>
@else
    {{-- Text button (e.g., "Cancel", "Close") --}}
    <{{ $as }}
        type="{{ $as === 'button' ? 'button' : '' }}"
        @click="close()"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50'
        ]) }}
    >
        {{ $slot }}
    </{{ $as }}>
@endif

