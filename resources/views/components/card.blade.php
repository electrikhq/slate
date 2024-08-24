@props([
    'size' => 'md', // Default size
    'color' => 'neutral', // Default color
    'outlined' => false, // Outlined style
    'header' => null, // Optional header content
    'footer' => null, // Optional footer content
    'icon' => null, // Optional icon in the header
    'iconPosition' => 'before',
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
    $iconColor = $color === 'black' ? 'white' : 'black'; // Icon color adjustment
    $textColorClass = $color === 'black' 
        ? 'text-white dark:text-black' 
        : 'text-black dark:text-white';
    $borderColorClass = $color === 'black' 
        ? 'border-neutral-200 dark:border-neutral-700' 
        : 'border-neutral-200 dark:border-neutral-700';
} else {
    // Handle other colors dynamically
    $colorClass = $outlined
        ? "border border-{$color}-600 text-{$color}-600 dark:border-{$color}-400 dark:text-{$color}-200"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-neutral-200";
    $iconColor = $outlined ? "{$color}-600" : 'white'; // Default icon color
    $textColorClass = $outlined 
        ? "text-{$color}-600 dark:text-{$color}-200" 
        : "text-white dark:text-neutral-200";
    $borderColorClass = "border-{$color}-600 dark:border-{$color}-400"; // Border color based on the color prop
}

$roundedClass = 'rounded-lg'; // Consistent rounded corners for cards
@endphp

<div {{ $attributes->merge(['class' => "$sizeClass $colorClass $roundedClass $textColorClass"]) }}>
    @if ($header)
        <div class="flex items-center {{ $borderColorClass }} border-b px-2 py-2">
            @if ($icon && $iconPosition == 'before')
                <x-slate::icon :icon="$icon" size="sm" color="{{ $iconColor }}" darkColor="{{ $iconColor }}" class="mr-2" />
            @endif
            <div class="flex-1">
                {{ $header }}
            </div>
            @if ($icon && $iconPosition == 'after')
                <x-slate::icon :icon="$icon" size="sm" color="{{ $iconColor }}" darkColor="{{ $iconColor }}" class="ml-2" />
            @endif
        </div>
    @endif

    <div class="px-2 py-4">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="{{ $borderColorClass }} border-t px-2 py-2">
            {{ $footer }}
        </div>
    @endif
</div>
