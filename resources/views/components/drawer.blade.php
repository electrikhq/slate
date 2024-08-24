@props([
    'size' => 'md', // Default size
    'color' => 'primary', // Default color
    'outlined' => false, // Outlined style
    'position' => 'left', // Position of the drawer ('left', 'right', 'top', 'bottom')
])

@php
// Define size classes for width or height based on position
$sizeClasses = [
    'left' => ['sm' => 'w-64', 'md' => 'w-80', 'lg' => 'w-96'],
    'right' => ['sm' => 'w-64', 'md' => 'w-80', 'lg' => 'w-96'],
    'top' => ['sm' => 'h-32', 'md' => 'h-48', 'lg' => 'h-64'],
    'bottom' => ['sm' => 'h-32', 'md' => 'h-48', 'lg' => 'h-64'],
];

$sizeClass = $sizeClasses[$position][$size] ?? $sizeClasses['left']['md'];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = $outlined
        ? ($color === 'black'
            ? 'text-black bg-transparent dark:text-white'  // Black outlined
            : 'text-black bg-transparent dark:bg-black dark:text-white')  // White outlined
        : ($color === 'black'
            ? 'bg-black text-white dark:bg-white dark:text-black'  // Black filled
            : 'bg-white text-black dark:bg-black dark:text-white'); // White filled
} else {
    // Handle other colors dynamically
    $colorClass = $outlined
        ? "text-{$color}-600 bg-transparent dark:text-{$color}-200"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-neutral-200";
}

// Determine position classes and transitions based on position
$positionClass = match ($position) {
    'right' => 'right-0 top-0 h-full rounded-l-lg',
    'top' => 'top-0 left-0 w-full rounded-b-lg',
    'bottom' => 'bottom-0 left-0 w-full rounded-t-lg',
    default => 'left-0 top-0 h-full rounded-r-lg', // Default to left
};

$visibilityClass = match ($position) {
    'right' => 'translate-x-full',
    'top' => '-translate-y-full',
    'bottom' => 'translate-y-full',
    default => '-translate-x-full', // Default to left
};

$openClass = match ($position) {
    'right' => 'translate-x-0',
    'top' => 'translate-y-0',
    'bottom' => 'translate-y-0',
    default => 'translate-x-0', // Default to left
};

$transitionClass = 'transition-transform ease-in-out duration-300';
$roundedClass = 'shadow-lg'; // Consistent rounded corners and shadow for drawers
@endphp

<div x-data="{ open: false }" 
     @keydown.escape.window="open = false" 
     class="relative">

    <!-- Toggle Button Slot -->
    <div @click="open = !open">
        {{ $toggleButton ?? '' }}
    </div>

    <!-- Backdrop -->
    <div x-show="open" 
         @click="open = false" 
         class="fixed inset-0 bg-black bg-opacity-50 transition-opacity ease-in-out duration-300 z-40"
         x-cloak>
    </div>

    <!-- Drawer -->
    <div x-show="open" 
         :class="{ '{{ $openClass }}': open, '{{ $visibilityClass }}': !open }"
         class="fixed {{ $positionClass }} {{ $visibilityClass }} {{ $sizeClass }} {{ $colorClass }} {{ $roundedClass }} {{ $transitionClass }} z-50"
         style="display: none;">
         
        <!-- Header Slot -->
        @if (isset($header))
            <div class="flex items-center p-4">
                <div class="flex-1">
                    {{ $header }}
                </div>
                <button type="button" @click="open = false" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-300 dark:hover:text-white">
                    <x-slate::icon icon="carbon-close" size="md" />
                </button>
            </div>
        @endif

        <!-- Content Slot -->
        <div class="p-4 flex-1 overflow-y-auto">
            {{ $slot }}
        </div>

        <!-- Footer Slot -->
        @if (isset($footer))
            <div class="p-4">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
