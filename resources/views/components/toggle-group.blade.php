{{-- toggle-group.blade.php --}}
@props([
    'type' => 'single', // single, multiple
    'value' => null, // For single: string, For multiple: array
    'disabled' => false,
])

@php
    $isMultiple = $type === 'multiple';
    $defaultValue = $isMultiple ? (is_array($value) ? $value : []) : ($value ?? null);
@endphp

<div
    x-data="{
        type: '{{ $type }}',
        value: @js($defaultValue),
        toggle(itemValue) {
            if (this.type === 'single') {
                this.value = this.value === itemValue ? null : itemValue;
            } else {
                const index = this.value.indexOf(itemValue);
                if (index > -1) {
                    this.value.splice(index, 1);
                } else {
                    this.value.push(itemValue);
                }
            }
        },
        isPressed(itemValue) {
            if (this.type === 'single') {
                return this.value === itemValue;
            } else {
                return this.value.includes(itemValue);
            }
        }
    }"
    role="group"
    aria-label="Toggle group"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md bg-muted p-1 text-muted-foreground']) }}
>
    {{ $slot }}
</div>

