@props([
    'name',
    'value',
    'checked' => false,
    'disabled' => false,
    'label' => null,
    'helpText' => null,
    'error' => null,
])


@php
$errorMessage = $error ?: ($name && $errors->has($name) ? $errors->first($name) : null);
@endphp


<div class="flex items-start">
    <div class="flex items-center h-5">
        <input {{ $attributes->merge([
            'type' => 'radio',
            'name' => $name,
            'id' => $value,
            'value' => $value,
            'class' => 'h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300' . ($errorMessage ? ' border-red-500' : ''),
            ]) }}
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />
    </div>
    @if ($label)
        <div class="ml-3 text-sm">
            <label for="{{ $value }}" class="block text-sm {{ $errorMessage ? 'text-red-600' : 'text-gray-900 dark:text-gray-300' }}">{{ $label }}</label>
            @if ($helpText)
                <p class="text-gray-500 dark:text-gray-400">{{ $helpText }}</p>
            @endif
        </div>
    @endif
    @if ($errorMessage)
        <p class="text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
