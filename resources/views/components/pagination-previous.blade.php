{{-- pagination-previous.blade.php --}}
@props([
    'href' => '#',
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';
    $hoverClasses = $disabled ? '' : 'hover:bg-accent hover:text-accent-foreground';
    $sizeClasses = 'h-10 px-4';
    $disabledClasses = $disabled ? 'pointer-events-none opacity-50' : '';
@endphp

<a
    href="{{ $href }}"
    aria-label="Go to previous page"
    @if($disabled) aria-disabled="true" @endif
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $hoverClasses . ' ' . $sizeClasses . ' ' . $disabledClasses)]) }}
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
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
    <span class="sr-only">Previous</span>
</a>

