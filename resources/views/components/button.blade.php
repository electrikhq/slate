@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'outlined' => false,
    'rounded' => false,
    'disabled' => false,
    'href' => null,
    'icon' => null, // New: Icon name
    'iconPosition' => 'prefix', // New: Icon position ('prefix' or 'suffix')
    'loading' => false, // New: Loading state
])

@php
// Base classes
$baseClasses = 'inline-flex items-center justify-center font-sans font-medium focus:outline-none transition ease-in-out duration-150';

// Loading classes
$loadingClasses = $loading ? 'relative' : '';

// Size classes
$sizeClasses = [
    'sm' => 'px-2.5 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm leading-6',
    'lg' => 'px-6 py-3 text-base',
][$size] ?? 'px-4 py-2 text-sm';

// Color classes with explicit dark and light support
// Color classes with explicit dark and light support, including 'black' and 'white'
$colorClasses = $outlined ? (
    in_array($color, ['black', 'white']) ? 
    "border border-{$color} text-{$color} hover:bg-{$color} hover:text-white dark:hover:bg-gray-800" : 
    "border border-{$color}-600 text-{$color}-600 hover:bg-{$color}-500 hover:text-white dark:border-{$color}-700 dark:text-{$color}-700 dark:hover:bg-{$color}-800 dark:hover:text-white"
) : (
    in_array($color, ['black', 'white']) ? 
    "text-white bg-{$color} hover:bg-gray-800 dark:bg-{$color} dark:text-gray-200 dark:hover:bg-gray-900" : 
    "text-white bg-{$color}-500 hover:bg-{$color}-600 dark:bg-{$color}-700 dark:text-gray-200 dark:hover:bg-{$color}-800"
);


// Icon color
$iconColor = (!$outlined) ? 'white' : $color;

// Rounded classes
$roundedClasses = $rounded ? 'rounded-full' : 'rounded-sm';

// Disabled classes
$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';

// Merge all classes
$classes = implode(' ', [$baseClasses, $loadingClasses, $sizeClasses, $colorClasses, $roundedClasses, $disabledClasses]);
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && $iconPosition === 'prefix') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'suffix') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</a>
@else
<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    @if($loading)
        <span class="mr-1">
            <x-slate::icon icon="carbon-renew" class="animate-spin" size="xs" color="$iconColor"/>
        </span>
    @endif
    @if($icon && $iconPosition === 'prefix') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="mr-1"/> @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'suffix') <x-slate::icon :icon="$icon" size="xs" color="$iconColor" class="ml-1"/> @endif
</button>
@endif
