{{-- tabs.blade.php --}}
@props([
    'defaultValue' => null,
    'value' => null,
])

@php
    $tabsId = $attributes->get('id', 'tabs-' . uniqid());
    $initialValue = $value ?? $defaultValue;
@endphp

<div
    x-data="{
        activeTab: @js($initialValue),
        setActiveTab(value) {
            this.activeTab = value;
        }
    }"
    x-id="['tabs']"
    wire:ignore
    id="{{ $tabsId }}"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot }}
</div>

