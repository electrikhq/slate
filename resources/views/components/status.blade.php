@props([
    'size' => 'md', // Size of the status dot: 'xs', 'sm', 'md', 'lg', 'xl'
    'color' => 'primary', // Color of the status dot, e.g., 'green', 'red', 'blue', 'yellow', 'black', 'white'
    'outlined' => false, // Outlined style
    'label' => null, // Optional label next to the status dot
])

@php
// Define size classes
$sizes = [
    'xs' => 'h-2 w-2',
    'sm' => 'h-3 w-3',
    'md' => 'h-4 w-4', // Default size
    'lg' => 'h-5 w-5',
    'xl' => 'h-6 w-6',
];

$sizeClass = $sizes[$size] ?? $sizes['md']; // Fallback to 'md' if size is not provided or invalid

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = $outlined
        ? ($color === 'black'
            ? 'bg-transparent border border-black text-black dark:bg-transparent dark:border-white dark:text-white'
            : 'bg-transparent border border-black text-black dark:bg-transparent dark:border-white dark:text-white')
        : ($color === 'black'
            ? 'bg-black text-white dark:bg-white dark:text-black'
            : 'bg-white text-black dark:bg-black dark:text-white');
} else {
    // Handle other colors dynamically
    $colorClass = $outlined
        ? "bg-transparent border border-{$color}-500 text-{$color}-500 dark:border-{$color}-400 dark:text-{$color}-400"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-neutral-200";
}

// Combine all classes
$classes = implode(' ', [$sizeClass, $colorClass, 'inline-block rounded-full']);
@endphp

<div class="flex items-center">
    <span {{ $attributes->merge(['class' => $classes]) }}></span>
    @if ($label)
        <span class="ml-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $label }}</span>
    @endif
</div>
