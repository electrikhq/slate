@props([
    'variant' => 'ghost',
    'size' => 'icon',
    'rounded' => null,
    'animation' => 'none',
    'as' => 'button',
    'type' => 'button',
])

@php
    $clipId = 'slate-theme-' . uniqid();
@endphp

<x-slate::button
    :variant="$variant"
    :size="$size"
    :rounded="$rounded"
    :animation="$animation"
    :as="$as"
    :type="$type"
    x-data="{ dark: document.documentElement.classList.contains('dark') }"
    x-on:click="dark = !dark; document.documentElement.classList.toggle('dark')"
    x-bind:aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
    {{ $attributes }}
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        aria-hidden="true"
    >
        <defs>
            <clipPath id="{{ $clipId }}">
                <path d="M12 3a9 9 0 0 1 0 18Z" />
            </clipPath>
        </defs>
        <circle cx="12" cy="12" r="9" />
        <path d="M12 3v18" />
        <g clip-path="url(#{{ $clipId }})" stroke-width="1.75">
            <path d="M12 5.5 20 13.5" />
            <path d="M12 9 21 18" />
            <path d="M12 12.5 20.5 21" />
            <path d="M12 16 18.5 22.5" />
        </g>
    </svg>
</x-slate::button>
