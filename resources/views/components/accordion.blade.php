{{-- accordion.blade.php --}}
@props([
    'type' => 'single', // 'single' or 'multiple'
    'collapsible' => true, // For single type, allow closing the open item
])

@php
    // Generate unique ID for this accordion instance
    $accordionId = $attributes->get('id', 'accordion-' . uniqid());
@endphp

<div
    x-data="{
        type: '{{ $type }}',
        collapsible: {{ $collapsible ? 'true' : 'false' }},
        openItems: [],
        toggleItem(itemId) {
            if (this.type === 'single') {
                if (this.openItems.includes(itemId)) {
                    if (this.collapsible) {
                        this.openItems = [];
                    }
                } else {
                    this.openItems = [itemId];
                }
            } else {
                const index = this.openItems.indexOf(itemId);
                if (index > -1) {
                    this.openItems.splice(index, 1);
                } else {
                    this.openItems.push(itemId);
                }
            }
        },
        isOpen(itemId) {
            return this.openItems.includes(itemId);
        }
    }"
    x-id="['accordion']"
    wire:ignore
    id="{{ $accordionId }}"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    {{ $slot }}
</div>

