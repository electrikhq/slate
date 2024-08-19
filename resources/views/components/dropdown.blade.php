@props([
    'label' => null, // The label for the dropdown trigger
    'size' => 'md', // Size of the dropdown: 'xs', 'sm', 'md', 'lg', 'xl'
    'color' => 'black', // Color of the dropdown trigger button
    'icon' => null, // Optional icon for the dropdown trigger
    'position' => 'bottom-left', // Position of the dropdown menu: 'bottom-right', 'bottom-left', 'top-right', 'top-left'
    'disabled' => false, // Disable the dropdown
    'hasShadow' => true, // Option to have shadow
])

@php
$sizes = [
    'xs' => 'text-xs py-1 px-2',
    'sm' => 'text-sm py-1 px-2',
    'md' => 'text-base py-1.5 px-3', // Default size
    'lg' => 'text-lg py-2 px-4',
];

$iconSizes = [
    'xs' => 'xs',
    'sm' => 'xs',
    'md' => 'sm',
    'lg' => 'md',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = $color === 'black'
        ? 'bg-black text-white dark:bg-white dark:text-black'
        : 'bg-white text-black dark:bg-black dark:text-white';
    $iconColor = $color === 'black' ? 'text-white dark:text-black' : 'text-black dark:text-white';
} else {
    // Handle other colors dynamically
    $colorClass = "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-gray-200";
    $iconColor = 'text-white'; // Default icon color when not black or white
}

// Determine the positioning classes for the dropdown menu
$positionClasses = match ($position) {
    'bottom-left' => 'left-0 top-full mt-1.5',
    'top-right' => 'right-0 bottom-full mb-1.5',
    'top-left' => 'left-0 bottom-full mb-1.5',
    default => 'right-0 top-full mt-1.5', // Default to bottom-right
};

// Handle shadow based on hasShadow prop
$shadowClass = $hasShadow ? 'shadow-lg' : '';
@endphp

<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Trigger Button -->
    <button @click="open = !open" :class="{ 'opacity-50 cursor-not-allowed': {{ $disabled ? 'true' : 'false' }} }"
            {{ $disabled ? 'disabled' : '' }}
            class="inline-flex items-center justify-between {{ $sizeClass }} {{ $colorClass }} rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-gray-700">
        @if($icon)
            <x-slate::icon :icon="$icon" :size="$iconSizes[$size]" color="{{ $iconColor }}" class="mr-1" />
        @endif
        {{ $label }}
        <x-slate::icon icon="carbon-chevron-down" :size="$iconSizes[$size]" color="{{ $iconColor }}" />
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.away="open = false" 
        class="absolute z-10 {{ $positionClasses }} min-w-[100%] bg-white dark:bg-black border border-gray-300 dark:border-gray-700 rounded-md {{ $shadowClass }} overflow-hidden">
        <div class="py-1" role="menu">
            {{ $slot }}
        </div>
    </div>
</div>
