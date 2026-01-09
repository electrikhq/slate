{{-- context-menu.blade.php --}}
@props([
    'id' => 'context-menu-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        x: 0,
        y: 0,
        close() {
            this.open = false;
        },
        openAt(event) {
            event.preventDefault();
            this.x = event.clientX;
            this.y = event.clientY;
            this.open = true;
        }
    }"
    x-id="['context-menu']"
    @keydown.escape.window="close()"
    @click.outside="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

