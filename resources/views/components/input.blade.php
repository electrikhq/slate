@props([
    'type' => 'text',
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'helpText' => null,
    'error' => null,
    'size' => 'md',
    'before' => null,
    'after' => null,
])

@php
// Define size classes with corresponding font sizes
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
                'block font-medium cursor-pointer text-gray-700 dark:text-gray-400',
                'text-danger-600' => ($name && $errors->has($name)),
                'text-red-600' => $errorMessage,
            ]) }}
        >
            {{ $label }}
        </label>
    @endif
    <div class="relative flex items-center">
        @if($before)
            <span class="inline-flex items-center {{ $sizeClass }} rounded-l-md border border-r-0 {{ $errorMessage ? 'border-red-600' : 'border-gray-300 dark:border-gray-900' }} bg-gray-50 dark:bg-gray-900/50 text-gray-500 dark:text-gray-300">
                {!! $before !!}
            </span>
        @endif
        <input {{ $attributes->merge([
            'type' => $type,
            'name' => $name,
            'value' => old($name, $value),
            'placeholder' => $placeholder,
            'id' => $id ?? $name,
            'class' => 'block w-full border shadow-xs placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-gray-500 dark:focus:border-gray-500 ' .
                      $sizeClass .
                      ($before ? ' rounded-l-none' : ' rounded-l-md') .
                      ($after ? ' rounded-r-none' : ' rounded-r-md') .
                      ($errorMessage ? ' border-red-600' : ' border-gray-300 dark:border-gray-900') .
                      ($disabled ? ' bg-gray-100' : '') .
                      ($readonly ? ' bg-gray-100' : '') .
                      ' dark:bg-black dark:text-white dark:border-gray-900 dark:placeholder-gray-600'
            ]) }}
            {{ $required ? 'required' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />
        @if($after)
            <span class="inline-flex items-center {{ $sizeClass }} rounded-r-md border border-l-0 {{ $errorMessage ? 'border-red-600' : 'border-gray-300 dark:border-gray-900' }} bg-gray-50 dark:bg-gray-900/50 text-gray-500 dark:text-gray-300">
                {!! $after !!}
            </span>
        @endif
    </div>
    @if($helpText)
        <p class="mt-1 text-sm font-light text-gray-800 dark:text-gray-300">{{ $helpText }}</p>
    @endif    
    @if ($errorMessage)
        <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
