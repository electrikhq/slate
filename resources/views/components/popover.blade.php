{{-- popover.blade.php --}}
@props([
    'id' => 'popover-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['popover']"
    @keydown.escape.window="close()"
    @click.outside="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

