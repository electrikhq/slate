@props([
    'size' => 'md', // Default size
    'color' => 'white', // Default color
    'outlined' => false, // Outlined style
    'header' => null, // Optional header content
    'footer' => null, // Optional footer content
    'icon' => null, // Optional icon in the header
])

@php
// Define size classes with reduced padding
$sizes = [
    'sm' => 'p-2 text-sm',
    'md' => 'p-2 text-base', // Reduced padding for default size
    'lg' => 'p-2 text-lg',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = $outlined
        ? ($color === 'black'
            ? 'border border-black text-black dark:border-white dark:text-white'  // Black outlined
            : 'border border-black text-black dark:bg-black dark:text-white dark:border-white')  // White outlined
        : ($color === 'black'
            ? 'bg-black text-white dark:bg-white dark:text-black'  // Black filled
            : 'bg-white text-black dark:bg-black dark:text-white'); // White filled
} else {
    // Handle other colors dynamically
    $colorClass = $outlined
        ? "border border-{$color}-600 text-{$color}-600 dark:border-{$color}-400 dark:text-{$color}-200"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-gray-200";
}

$roundedClass = 'rounded-lg'; // Consistent rounded corners and shadow for cards
@endphp

<div {{ $attributes->merge(['class' => "$sizeClass $colorClass $roundedClass"]) }}>
    @if ($header)
        <div class="flex items-center border-b border-gray-200 dark:border-gray-700 px-2 py-2">
            @if ($icon)
                <x-slate::icon :icon="$icon" size="sm" class="mr-2" />
            @endif
            <div class="flex-1">
                {{ $header }}
            </div>
        </div>
    @endif

    <div class="px-2 py-4">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="border-t border-gray-200 dark:border-gray-700 px-2 py-2">
            {{ $footer }}
        </div>
    @endif
</div>
