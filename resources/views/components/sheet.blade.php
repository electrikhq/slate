{{-- sheet.blade.php --}}
@props([
    'id' => 'sheet-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['sheet']"
    @keydown.escape.window="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

