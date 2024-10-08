@props([
    'name' => 'toggle', // Name of the toggle
    'checked' => false, // Whether the toggle is checked by default
    'disabled' => false, // Whether the toggle is disabled
    'size' => 'md', // Size of the toggle: 'sm', 'md', 'lg'
    'color' => 'black', // Color of the toggle when checked
    'label' => null, // Label text for the toggle
    'error' => null, // Error message
    'helpText' => null, // Optional help text
    'value' => '', // Value for the toggle
])

@php
// Define size classes
$sizes = [
    'sm' => 'w-9 h-5 after:h-4 after:w-4 after:top-[2px] after:left-[2px]',
    'md' => 'w-11 h-6 after:h-5 after:w-5 after:top-[2px] after:left-[2px]', // Default size
    'lg' => 'w-14 h-7 after:h-6 after:w-6 after:top-0.5 after:left-[4px]',
];

// Handle black and white colors explicitly
if (in_array($color, ['black', 'white'])) {
    $colorClass = ($color === 'black')
        ? 'peer-checked:bg-black peer-focus:ring-neutral-500 dark:peer-checked:bg-white dark:peer-focus:ring-neutral-700'
        : 'peer-checked:bg-white peer-focus:ring-neutral-300 dark:peer-checked:bg-neutral-200 dark:peer-focus:ring-neutral-600';
} else {
    // Handle other colors dynamically
    $colorClass = "peer-checked:bg-{$color}-600 peer-focus:ring-{$color}-300 dark:peer-checked:bg-{$color}-700 dark:peer-focus:ring-{$color}-800";
}

$sizeClass = $sizes[$size] ?? $sizes['md'];

$errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : null);

@endphp

<label class="flex items-start cursor-pointer">
    <div class="flex items-center h-5">
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            value="{{ $value }}"
            {{ $attributes->merge(['class' => "sr-only peer"]) }}
            {{ $checked ? 'checked' : '' }} 
            {{ $disabled ? 'disabled' : '' }} 
        />
        <div class="relative {{ $sizeClass }} bg-neutral-200 rounded-full peer dark:bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 {{ $colorClass }} peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:bg-white after:border-neutral-300 after:border dark:border-neutral-600 after:rounded-full after:transition-all"></div>
    </div>
    @if ($label)
        <div class="ml-3 text-sm">
            <span class="font-medium  {{ $errorMessage ? 'text-red-600' : 'text-neutral-700 dark:text-neutral-300' }}">{{ $label }}</span>
            @if ($helpText)
                <p class="text-neutral-500 dark:text-neutral-400">{{ $helpText }}</p>
            @endif
        </div>
    @endif
</label>

@if ($errorMessage)
    <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
@endif
