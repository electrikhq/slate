{{-- tooltip.blade.php --}}
@props([
    'id' => 'tooltip-' . uniqid(),
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
    x-id="['tooltip']"
    @mouseenter="show()"
    @mouseleave="hide()"
    @focusin="show()"
    @focusout="hide()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative inline-block']) }}
>
    {{ $slot }}
</div>

