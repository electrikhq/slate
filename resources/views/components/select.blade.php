@props([
    'label' => null, // Optional label text
    'name' => '', // Name attribute for the select
    'options' => [], // Options for the select dropdown
    'size' => 'md', // Size of the select element
    'placeholder' => null, // Optional placeholder option
    'helpText' => null,
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
    'xl' => 'px-6 py-6 text-xl',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];
$textSizes = [
    'sm' => 'text-sm',
    'md' => 'text-base', // Default size
    'lg' => 'text-lg',
    'xl' => 'text-xl',
];

$labelTextSize = $textSizes[$size] ?? $textSizes['md'];

// Combine all classes
$selectClasses = 'block w-full border border-neutral-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ' .
                 ($disabled ? 'bg-neutral-100 cursor-not-allowed' : '') .
                 ' dark:bg-black dark:text-white dark:border-neutral-900 dark:placeholder-neutral-600';

$labelClasses = 'block font-medium text-neutral-700 dark:text-neutral-300 ' . $labelTextSize;

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

    @if($helpText)
        <p class="mt-1 text-sm font-light text-neutral-700 dark:text-neutral-400">{{ $helpText }}</p>
    @endif    

    @if ($errorMessage)
        <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
