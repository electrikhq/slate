@props([
    'color' => 'primary', // Default color
    'size' => 'md', // Default size
    'icon' => null, // Optional: Icon component to display inside the badge
    'text' => null, // Text or number to display inside the badge
    'outlined' => false, // Option to make the badge outlined
])

@php
// Define size classes
$sizes = [
    'xs' => 'text-xs px-1.5 py-0.5',
    'sm' => 'text-sm px-2 py-1',
    'md' => 'text-base px-2.5 py-1.5', // Default size
    'lg' => 'text-lg px-3 py-2',
];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = $outlined
        ? ($color === 'black'
            ? 'text-black border border-black dark:text-white dark:border-white' // Black outlined
            : 'text-black border border-black dark:text-white dark:border-white') // White outlined, with black text in light mode
        : ($color === 'black'
            ? 'bg-black text-white dark:bg-white dark:text-black' // Black filled
            : 'bg-white text-black dark:bg-black dark:text-white'); // White filled
} else {
    // Handle other colors dynamically
    $colorClass = $outlined
        ? "text-{$color}-600 border border-{$color}-600 dark:text-{$color}-400 dark:border-{$color}-400"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-gray-200";
}

$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-full $sizeClass $colorClass"]) }}>
    @if($icon)
        <x-slate::icon :icon="$icon" :size="$size" color="{{ $outlined ? $color : 'white' }}" class="ml-1 mr-1" />
    @endif
    {{ $text ?? $slot ?? ''}}
</span>
