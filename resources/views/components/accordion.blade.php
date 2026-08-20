@props([
    'type' => 'single',
    'defaultValue' => null,
    'value' => null,
    'collapsible' => true,
    'as' => 'div',
])

@php
    $resolvedType = in_array($type, ['single', 'multiple'], true) ? $type : 'single';
    $isCollapsible = filter_var($collapsible, FILTER_VALIDATE_BOOL);

    $initial = $value ?? $defaultValue;

    if ($resolvedType === 'multiple') {
        if (is_string($initial) && $initial !== '') {
            $initial = array_values(array_filter(array_map('trim', explode(',', $initial))));
        } elseif (! is_array($initial)) {
            $initial = [];
        }
    } else {
        $initial = is_array($initial) ? (string) ($initial[0] ?? '') : (string) ($initial ?? '');
    }
@endphp

<{{ $as }}
    data-slot="accordion"
    data-type="{{ $resolvedType }}"
    x-data="{
        type: @js($resolvedType),
        value: @js($initial),
        collapsible: {{ $isCollapsible ? 'true' : 'false' }},
        mounted: false,
        init() {
            this.$nextTick(() => { this.mounted = true })
        },
        isOpen(item) {
            return this.type === 'multiple'
                ? this.value.includes(item)
                : this.value === item
        },
        toggle(item) {
            if (this.type === 'multiple') {
                this.value = this.isOpen(item)
                    ? this.value.filter((v) => v !== item)
                    : [...this.value, item]
                return
            }

            this.value = this.collapsible && this.value === item ? '' : item
        }
    }"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot }}
</{{ $as }}>
