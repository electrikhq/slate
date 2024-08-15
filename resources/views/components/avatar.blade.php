@props([
    'size' => 'md', // Default size
    'src' => null, // Image source
    'alt' => '', // Alt text for the image
    'initials' => null, // Initials to display if no image
    'rounded' => true, // Whether the avatar is fully rounded
    'status' => null, // Status indicator (e.g., 'online', 'offline', 'busy')
    'color' => 'gray', // Background color for initials and status
    'outlined' => false, // Outlined style

])

@php
// Define size classes
$sizes = [
    'sm' => 'w-8 h-8 text-sm',
    'md' => 'w-12 h-12 text-base', // Default size
    'lg' => 'w-16 h-16 text-lg',
    'xl' => 'w-20 h-20 text-xl',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Define rounded classes
$roundedClass = $rounded ? 'rounded-full' : 'rounded-md';

// Handle black and white colors explicitly for background and outline
if (in_array($color, ['black', 'white'])) {
    $bgColorClass = $outlined
        ? ($color === 'black'
            ? 'bg-black text-white border border-black dark:bg-white dark:text-black dark:border-white' // Black outlined
            : 'bg-white text-black border border-black dark:bg-black dark:text-white dark:border-white') // White outlined
        : ($color === 'black'
            ? 'bg-black text-white dark:bg-white dark:text-black' // Black filled
            : 'bg-white text-black dark:bg-black dark:text-white'); // White filled
} else {
    // Handle other colors dynamically
    $bgColorClass = $outlined
        ? "bg-{$color}-500 text-white border border-{$color}-600 dark:bg-{$color}-700 dark:border-{$color}-400 dark:text-{$color}-200"
        : "bg-{$color}-500 text-white dark:bg-{$color}-700 dark:text-white";
}


// Status indicator classes
$statusColors = [
    'online' => 'bg-green-500',
    'offline' => 'bg-gray-500',
    'busy' => 'bg-red-500',
];
$statusClass = $status ? ($statusColors[$status] ?? 'bg-gray-500') : null;
@endphp

<div class="relative inline-block {{ $sizeClass }} {{ $roundedClass }} overflow-hidden {{ $bgColorClass }} z-0">
    @if ($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="object-cover w-full h-full {{ $roundedClass }}">
    @elseif ($initials)
        <span class="flex items-center justify-center w-full h-full font-bold">
            {{ $initials }}
        </span>
    @endif

    @if ($status)
        <span class="absolute z-10 bottom-0 right-0 block w-3 h-3 {{ $roundedClass }} {{ $statusClass }} ring-2 ring-white dark:ring-gray-900"></span>
    @endif
</div>
