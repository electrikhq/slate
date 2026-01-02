{{-- alert-dialog.blade.php --}}
@props([
    'id' => 'alert-dialog-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['alert-dialog']"
    @keydown.escape.window="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

