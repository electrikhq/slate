{{-- checkbox.blade.php --}}
@props([
    'checked' => false,
    'disabled' => false,
    'name' => null,
    'value' => '1',
    'id' => 'checkbox-' . uniqid(),
])

@php
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
@endphp

<button
    type="button"
    role="checkbox"
    :aria-checked="checked"
    @click="if (!{{ $disabled ? 'true' : 'false' }}) { checked = !checked; $dispatch('change', { checked: checked }); if ($refs.hiddenInput) { $refs.hiddenInput.checked = checked; } }"
    :disabled="{{ $disabled ? 'true' : 'false' }}"
    x-data="{ checked: {{ $checked ? 'true' : 'false' }} }"
    id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground'
    ]) }}
    :class="checked ? 'bg-primary text-primary-foreground border-primary' : 'border-input'"
>
    <span
        class="flex items-center justify-center text-current"
        :class="checked ? 'block' : 'hidden'"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="12"
            height="12"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="3"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-4 w-4"
        >
            <polyline points="20 6 9 17 4 12" />
        </svg>
    </span>
</button>

@if($name)
    <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        :checked="checked"
        :disabled="{{ $disabled ? 'true' : 'false' }}"
        class="sr-only"
        x-ref="hiddenInput"
    />
@endif
