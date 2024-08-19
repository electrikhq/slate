@props([
    'type' => 'button',
    'color' => 'black', // Default to white if no color is provided
    'size' => 'md',
    'outlined' => false,
    'rounded' => false,
    'disabled' => false,
    'href' => null,
    'icon' => null, // Icon name
    'iconPosition' => 'before', // Icon position ('before' or 'after')
    'loading' => false, // Loading state
])

@php
// Base classes
$baseClasses = 'inline-flex items-center justify-center font-medium focus:outline-none transition ease-in-out duration-150';

// Loading classes
$loadingClasses = $loading ? 'relative' : '';

// Size classes with consistent spacing and font sizes
$sizes = [
    'sm' => 'px-2.5 py-1.5 text-sm',
    'md' => 'px-3 py-2 text-base',  // Consistent with input's md
    'lg' => 'px-4 py-3 text-lg',    // Consistent with input's lg
    'xl' => 'px-5 py-4 text-xl',    // Consistent with input's xl
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Color classes with explicit dark and light support, ensuring inversion for black and white
$colorClasses = $outlined ? (
    in_array($color, ['black', 'white']) ? 
    ($color === 'black' ? "border-black text-black hover:bg-gray-800 dark:border-white dark:text-white dark:hover:bg-gray-200" : "border-white text-white hover:bg-gray-100 dark:border-black dark:text-black dark:hover:bg-gray-800") : 
    "border border-{$color}-600 text-{$color}-600 hover:bg-{$color}-500 hover:text-white dark:border-{$color}-700 dark:text-{$color}-700 dark:hover:bg-{$color}-800 dark:hover:text-white"
) : (
    in_array($color, ['black', 'white']) ? 
    ($color === 'black' ? "text-white bg-black hover:bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-gray-200" : "text-black bg-white hover:bg-gray-100 dark:bg-black dark:text-white dark:hover:bg-gray-800") : 
    "text-white bg-{$color}-500 hover:bg-{$color}-600 dark:bg-{$color}-700 dark:text-gray-200 dark:hover:bg-{$color}-800"
);

// Icon color
$iconColor = (!$outlined) ? 'white' : $color;

// Rounded classes consistent with inputs
$roundedClasses = $rounded ? 'rounded-full' : 'rounded-md';

// Disabled classes
$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';

// Merge all classes
$classes = implode(' ', [$baseClasses, $loadingClasses, $sizeClass, $colorClasses, $roundedClasses, $disabledClasses]);
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && $iconPosition === 'before') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'after') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</a>
@else
<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    @if($loading)
        <span class="mr-1">
            <x-slate::icon icon="carbon-renew" class="animate-spin" size="xs" color="$iconColor"/>
        </span>
    @endif
    @if($icon && $iconPosition === 'before') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'after') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</button>
@endif
