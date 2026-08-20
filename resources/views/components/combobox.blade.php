@props([
    'open' => false,
    'value' => null,
    'placeholder' => 'Select...',
    'as' => 'div',
])

@php
    $isOpen = filter_var($open, FILTER_VALIDATE_BOOL);
    $initial = $value ?? '';
@endphp

<{{ $as }}
    data-slot="combobox"
    x-data="{
        open: {{ $isOpen ? 'true' : 'false' }},
        value: @js((string) $initial),
        query: @js((string) $initial),
        select(val, text) {
            this.value = val;
            this.query = text;
            this.open = false;
        }
    }"
    @keydown.escape.window="if (open) open = false"
    @click.outside="open = false"
    {{ $attributes->merge(['class' => 'relative w-full']) }}
>
    {{ $slot }}
</{{ $as }}>
