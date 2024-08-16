@props([
    'for',
    'value' => '',
])

<label {{ $attributes->merge(['for' => $for, 'class' => 'block text-sm font-medium text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
