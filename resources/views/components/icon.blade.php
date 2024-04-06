@props([
    'icon',
    'size' => 'md',
    'color' => 'currentColor', // Default to 'currentColor' to inherit from parent
    'darkColor' => 'white', // Default to 'white' for dark mode if no color is specified
    'class' => '',
])

@php
// Define size mappings
$sizes = [
    'xs' => 'h-4 w-4',
    'sm' => 'h-6 w-6',
    'md' => 'h-8 w-8',
    'lg' => 'h-10 w-10',
    'xl' => 'h-12 w-12',
];

// Map the size prop to actual sizes
$sizeClass = $sizes[$size] ?? 'h-6 w-6';

// If no specific color is provided, use a default dark mode color
if ($color === 'currentColor' && $darkColor) {
    $colorClass = "text-{$color} dark:text-{$darkColor}";
} else {
    // Define color mappings based on your TailwindCSS config
    $colors = [
        'primary' => 'text-primary-500 dark:text-primary-400',
        'secondary' => 'text-secondary-500 dark:text-secondary-400',
        'success' => 'text-success-500 dark:text-success-400',
        'danger' => 'text-danger-500 dark:text-danger-400',
        'warning' => 'text-warning-500 dark:text-warning-400',
        'info' => 'text-info-500 dark:text-info-400',
        'light' => 'text-gray-100 dark:text-gray-300',
        'dark' => 'text-gray-800 dark:text-gray-600',
        // Add more mappings as needed
    ];

    // Map the color prop to actual TailwindCSS color classes
    $colorClass = $colors[$color] ?? $color; // Fallback to directly using the color prop if no mapping found
}

// Combine all classes
$allClasses = implode(' ', [$sizeClass, $colorClass, $class]);
@endphp

<x-dynamic-component :component="$icon" class="{{ $allClasses }}" {{ $attributes }}/>
