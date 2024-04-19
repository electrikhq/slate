@props([
    'color' => 'primary', // Default color
    'size' => 'md', // Default size
    'icon' => null, // Optional: Icon component to display inside the badge
    'text' => null, // Text or number to display inside the badge
])

@php
// Define size classes
$sizes = [
    'xs' => 'text-xs px-1.5 py-0.5',
    'sm' => 'text-sm px-2 py-1',
    'md' => 'text-base px-2.5 py-1.5',
    'lg' => 'text-lg px-3 py-2',
];

// Define color classes with dark mode variants
$colors = [
    'primary' => 'bg-blue-500 text-white dark:bg-blue-700 dark:text-gray-200',
    'secondary' => 'bg-gray-500 text-white dark:bg-gray-700 dark:text-gray-300',
    'success' => 'bg-green-500 text-white dark:bg-green-700 dark:text-gray-200',
    'danger' => 'bg-red-500 text-white dark:bg-red-700 dark:text-gray-200',
    'warning' => 'bg-yellow-500 text-black dark:bg-yellow-600 dark:text-gray-900',
    'info' => 'bg-teal-500 text-white dark:bg-teal-700 dark:text-gray-200',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];
$colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-full $sizeClass $colorClass"]) }}>
    @if($icon)
        <x-slate::icon :icon="$icon" :size="$size" color="light" class="ml-1 mr-1" />
    @endif
    {{ $text ?? $slot ?? ''}}
</span>
