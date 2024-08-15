@props([
    'size' => 'md', // Default size
    'dismissible' => false, // Option to make the alert dismissible
    'icon' => null, // Optional icon
    'color' => 'blue', // Default color
    'outlined' => false, // Outlined style
    'fullWidth' => false, // Full-width style
])

@php
// Define size classes
$sizes = [
    'sm' => 'px-3 py-2 text-sm',
    'md' => 'px-4 py-3 text-base', // Default size
    'lg' => 'px-5 py-4 text-lg',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClasses = $outlined
        ? ($color === 'black' 
            ? 'border-black text-black dark:border-white dark:text-white' 
            : 'border-white text-black dark:border-black dark:text-white')
        : ($color === 'black' 
            ? 'bg-black text-white dark:bg-white dark:text-black' 
            : 'bg-white text-black dark:bg-black dark:text-white');
} else {
    // Handle other colors dynamically
    $colorClasses = $outlined
        ? "border border-{$color}-600 text-{$color}-600 dark:border-{$color}-400 dark:text-{$color}-200"
        : "bg-{$color}-100 text-{$color}-800 dark:bg-{$color}-900 dark:text-{$color}-200";
}

$fullWidthClass = $fullWidth ? 'w-full mx-0 px-2' : 'rounded-md shadow-sm';

// Dismissible button class
$dismissButtonClass = 'text-current hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 dark:hover:text-gray-300';

// Merge all classes
$classes = implode(' ', [$sizeClass, $colorClasses, $fullWidthClass, 'flex items-center justify-between']);
@endphp

<div x-data="{ alertDismissed: false }" x-show="!alertDismissed" {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center">
        @if ($icon)
            <x-slate::icon :icon="$icon" size="sm" class="mr-3"/>
        @endif
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button type="button" class="ml-3 {{ $dismissButtonClass }}" aria-label="Dismiss" @click="alertDismissed = true">
            <x-slate::icon icon="carbon-close" size="sm" />
        </button>
    @endif
</div>
