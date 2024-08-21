@props([
    'label' => null, // Label text
    'name' => '', // Name attribute for the textarea
    'value' => '', // Initial value of the textarea
    'placeholder' => '', // Placeholder text
    'required' => false, // Whether the textarea is required
    'readonly' => false, // Whether the textarea is readonly
    'disabled' => false, // Whether the textarea is disabled
    'size' => 'md', // Size of the textarea: 'sm', 'md', 'lg', 'xl'
    'helpText' => null, // Optional help text
    'error' => null, // Error message
])

@php
// Define size classes with corresponding font sizes and paddings
$sizes = [
    'sm' => 'px-2 py-1 text-sm',    // Smaller padding and font size
    'md' => 'px-3 py-2 text-base',  // Default padding and font size
    'lg' => 'px-4 py-3 text-lg',    // Larger padding and font size
    'xl' => 'px-5 py-4 text-xl',    // Extra-large padding and font size
];

$sizeClass = $sizes[$size] ?? $sizes['md']; // Fallback to 'md' if size is not provided or invalid

$errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : null);

@endphp

<div class="space-y-1">
    @if ($label)
        <label
            for="{{ $name }}"
            {{ $attributes->class([
                'block font-medium cursor-pointer text-neutral-700 dark:text-neutral-300',
                'text-danger-600' => ($name && $errors->has($name)),
                'text-red-600' => $errorMessage,
            ]) }}
        >
            {{ $label }}
        </label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'block w-full border shadow-xs placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-gray-500 dark:focus:border-gray-500 ' .
                       $sizeClass .
                       ' rounded-md' .
                       ($errorMessage ? ' border-red-600' : ' border-neutral-300 dark:border-neutral-900') .
                       ($disabled ? ' bg-neutral-100' : '') .
                       ($readonly ? ' bg-neutral-100' : '') .
                       ' dark:bg-black dark:text-white dark:placeholder-neutral-600',
        ]) }}
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    >{{ old($name, $value) }}</textarea>
    @if($helpText)
        <p class="mt-1 text-sm font-light text-neutral-800 dark:text-neutral-300">{{ $helpText }}</p>
    @endif
    @if ($errorMessage)
        <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
