@props([
    'label' => '', // The label of the dropdown item
    'icon' => null, // Optional icon
    'description' => null, // Optional description text
    'disabled' => false, // Whether the item is disabled
])

@php
$baseClasses = 'flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer';
$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';
@endphp

<a {{ $attributes->merge(['class' => "{$baseClasses} {$disabledClasses}"]) }}>
    @if($icon)
        <x-slate::icon :icon="$icon" size="sm" class="mr-2"/>
    @endif
    <div class="flex flex-col">
        <span>{{ $label }}</span>
        @if($description)
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $description }}</span>
        @endif
    </div>
</a>
