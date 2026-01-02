{{-- dialog.blade.php --}}
@props([
    'id' => 'dialog-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['dialog']"
    @keydown.escape.window="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>
