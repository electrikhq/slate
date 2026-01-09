{{-- switch.blade.php --}}
@props([
    'checked' => false,
    'disabled' => false,
    'name' => null,
    'value' => '1',
    'id' => 'switch-' . uniqid(),
])

@php
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
@endphp

<button
    type="button"
    role="switch"
    :aria-checked="checked"
    @click="if (!{{ $disabled ? 'true' : 'false' }}) { checked = !checked; $dispatch('change', { checked: checked }); if ($refs.hiddenInput) { $refs.hiddenInput.value = checked ? '{{ $value }}' : ''; } }"
    :disabled="{{ $disabled ? 'true' : 'false' }}"
    x-data="{ checked: {{ $checked ? 'true' : 'false' }} }"
    id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'peer inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50'
    ]) }}
    :class="checked ? 'bg-primary' : 'bg-input'"
>
    <span
        class="pointer-events-none block h-5 w-5 rounded-full bg-background shadow-lg ring-0 transition-transform"
        :class="checked ? 'translate-x-5' : 'translate-x-0'"
    ></span>
</button>

@if($name)
    <input
        type="hidden"
        name="{{ $name }}"
        value="{{ $checked ? $value : '' }}"
        x-ref="hiddenInput"
    />
@endif
