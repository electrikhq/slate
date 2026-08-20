@props([
    'type' => 'single',
    'variant' => 'default',
    'size' => 'default',
    'defaultValue' => null,
    'value' => null,
    'as' => 'div',
])

@php
    $resolvedType = in_array($type, ['single', 'multiple'], true) ? $type : 'single';
    $resolvedVariant = in_array($variant, ['default', 'outline'], true) ? $variant : 'default';
    $resolvedSize = in_array($size, ['default', 'sm', 'lg'], true) ? $size : 'default';

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

    $classes = trim(implode(' ', [
        'group/toggle-group flex w-fit items-center rounded-md data-[variant=outline]:shadow-xs',
        $resolvedVariant === 'outline' ? 'gap-0' : 'gap-1',
    ]));
@endphp

<{{ $as }}
    data-slot="toggle-group"
    data-variant="{{ $resolvedVariant }}"
    data-size="{{ $resolvedSize }}"
    role="group"
    x-data="{
        type: @js($resolvedType),
        value: @js($initial),
        variant: @js($resolvedVariant),
        size: @js($resolvedSize),
        isOn(item) {
            return this.type === 'multiple'
                ? this.value.includes(item)
                : this.value === item
        },
        toggle(item) {
            if (this.type === 'multiple') {
                this.value = this.isOn(item)
                    ? this.value.filter((v) => v !== item)
                    : [...this.value, item]
                return
            }

            this.value = this.value === item ? '' : item
        }
    }"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
