{{-- hover-card.blade.php --}}
@props([
    'id' => 'hover-card-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        show() {
            this.open = true;
        },
        hide() {
            this.open = false;
        }
    }"
    x-id="['hover-card']"
    @mouseenter="show()"
    @mouseleave="hide()"
    @focusin="show()"
    @focusout="hide()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

