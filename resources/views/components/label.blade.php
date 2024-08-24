@props([
    'for',
    'value' => '',
    'size' => 'md'
])

<label {{ $attributes->merge(['for' => $for, 'class' => 'block text-{{ $size }} font-medium text-neutral-700 dark:text-neutral-300']) }}>
    {{ $value ?? $slot }}
</label>
