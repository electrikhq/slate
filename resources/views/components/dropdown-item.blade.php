@props([
    'label' => '', // The label of the dropdown item
    'icon' => null, // Optional icon
    'description' => null, // Optional description text
    'disabled' => false, // Whether the item is disabled
    'size' => 'md', // Size inherited from parent dropdown
])

@php
$sizes = [
    'xs' => 'text-xs py-1 px-2',
    'sm' => 'text-sm py-1 px-2',
    'md' => 'text-base py-1.5 px-3', // Default size
    'lg' => 'text-lg py-2 px-4',
];

$iconSizes = [
    'xs' => 'xs',
    'sm' => 'xs',
    'md' => 'sm',
    'lg' => 'md',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];
$iconSizeClass = $iconSizes[$size] ?? $iconSizes['md'];

$baseClasses = 'flex items-center text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer whitespace-nowrap';
$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';
@endphp

<a {{ $attributes->merge(['class' => "{$baseClasses} {$disabledClasses} {$sizeClass}"]) }} style="min-width: 160px;">
    @if($icon)
        <x-slate::icon :icon="$icon" :size="$iconSizeClass" class="mr-2"/>
    @endif
    <div class="flex flex-col">
        <span>{{ $label }}</span>
        @if($description)
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $description }}</span>
        @endif
    </div>
</a>
