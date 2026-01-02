{{-- drawer.blade.php --}}
@props([
    'id' => 'drawer-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['drawer']"
    @keydown.escape.window="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

