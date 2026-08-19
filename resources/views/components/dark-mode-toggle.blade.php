@props([
    'size' => 'default',
])

@php
    $sizeClasses = [
        'sm' => 'size-8',
        'default' => 'size-9',
        'lg' => 'size-10',
    ];

    $iconSizeClasses = [
        'sm' => 'size-3.5',
        'default' => 'size-4',
        'lg' => 'size-5',
    ];

    $resolvedSize = $sizeClasses[$size] ?? $sizeClasses['default'];
    $resolvedIconSize = $iconSizeClasses[$size] ?? $iconSizeClasses['default'];
@endphp

<button
    type="button"
    data-slot="dark-mode-toggle"
    x-data="{ dark: document.documentElement.classList.contains('dark') }"
    x-on:click="dark = !dark; document.documentElement.classList.toggle('dark')"
    {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center rounded-md border border-input bg-background text-foreground shadow-xs transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 outline-none cursor-pointer {$resolvedSize}",
    ]) }}
    :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
>
    {{-- Sun (shown in dark mode) --}}
    <svg
        x-show="dark"
        x-cloak
        class="{{ $resolvedIconSize }}"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <circle cx="12" cy="12" r="4" />
        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
    </svg>
    {{-- Moon (shown in light mode) --}}
    <svg
        x-show="!dark"
        class="{{ $resolvedIconSize }}"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
    </svg>
</button>
