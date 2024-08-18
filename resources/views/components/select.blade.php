@props([
    'label' => null, // Optional label text
    'name' => '', // Name attribute for the select
    'options' => [], // Options for the select dropdown
    'size' => 'md', // Size of the select element
    'placeholder' => null, // Optional placeholder option
    'disabled' => false, // Disabled state
    'required' => false, // Required state
    'multiple' => false, // Allow multiple selections
    'error' => null, // Error message
])

@php
// Define size classes for the select element
$sizes = [
    'sm' => 'px-2 py-1 text-sm',
    'md' => 'px-3 py-2 text-base', // Default size
    'lg' => 'px-4 py-3 text-lg',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];

// Combine all classes
$selectClasses = 'block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ' .
                 ($disabled ? 'bg-gray-100 cursor-not-allowed' : '') .
                 ' dark:bg-black dark:text-white dark:border-gray-900 dark:placeholder-gray-600';

$labelClasses = 'block text-sm font-medium text-gray-700 dark:text-gray-300';

$errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : null);

@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="{{ $labelClasses }} {{ $errorMessage ? 'text-red-600' : '' }}">
            {{ $label }}
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => $selectClasses . ' ' . $sizeClass]) }}
            {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} {{ $multiple ? 'multiple' : '' }}>
        @if ($placeholder)
            <option value="" disabled {{ $required ? 'selected' : '' }}>{{ $placeholder }}</option>
        @endif
        @foreach ($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>

    @if ($errorMessage)
        <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
