{{-- collapsible.blade.php --}}
@props([
    'open' => false, // Initial open state
])

@php
    // Generate unique ID for this collapsible instance
    $collapsibleId = $attributes->get('id', 'collapsible-' . uniqid());
@endphp

<div
    x-data="{
        open: {{ $open ? 'true' : 'false' }},
        toggle() {
            this.open = !this.open;
        }
    }"
    x-id="['collapsible']"
    wire:ignore
    id="{{ $collapsibleId }}"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot }}
</div>

