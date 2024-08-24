@props([
    'name',
    'value',
    'checked' => false,
    'disabled' => false,
    'label' => null,
    'helpText' => null,
    'error' => null,
    'size' => 'md', // Add size prop
])

@php
$errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : null);

// Define size classes
$sizes = [
    'sm' => 'h-3 w-3 text-sm',
    'md' => 'h-4 w-4 text-base', // Default size
    'lg' => 'h-5 w-5 text-lg',
    'xl' => 'h-6 w-6 text-xl',
];

$sizeClass = $sizes[$size] ?? $sizes['md']; // Fallback to 'md' if size is not provided or invalid
@endphp

<div class="flex flex-col items-start">
    <div class="flex items-start">
        <input {{ $attributes->merge([
            'type' => 'radio',
            'name' => $name,
            'id' => $value,
            'value' => $value,
            'class' => "ml-1 mt-1 text-indigo-600 focus:ring-indigo-500 {$sizeClass} border-neutral-300 rounded-full" . ($errorMessage ? ' border-red-500' : ''),
            ]) }}
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />
        @if ($label)
        <div class="ml-3">
            <label for="{{ $value }}" class="block font-medium {{ $errorMessage ? 'text-red-600' : 'text-neutral-900 dark:text-neutral-300' }}">
                {{ $label }}
            </label>
            @if ($helpText)
            <p class="text-neutral-500 dark:text-neutral-400 mt-1 text-sm">{{ $helpText }}</p>
            @endif
        </div>
        @endif
    </div>
    @if ($errorMessage)
        <p class="text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
