{{-- combobox-item.blade.php --}}
@props([
    'value' => null,
    'label' => null,
    'disabled' => false,
])

@php
    $itemValue = $value ?? uniqid();
    $itemLabel = $label ?? $slot->toHtml();
    $baseClasses = 'relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50';
    $disabledClasses = $disabled ? 'pointer-events-none opacity-50' : '';
@endphp

<div
    role="option"
    @if(!$disabled) @click="select('{{ $itemValue }}', '{{ addslashes($itemLabel) }}')" @endif
    @click.stop
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $disabledClasses)]) }}
    @if($disabled) data-disabled="true" @endif
>
    {{ $slot }}
</div>

