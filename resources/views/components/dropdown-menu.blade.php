{{-- dropdown-menu.blade.php --}}
@props([
    'id' => 'dropdown-menu-' . uniqid(),
])

<div
    x-data="{
        open: false,
        id: '{{ $id }}',
        close() {
            this.open = false;
        }
    }"
    x-id="['dropdown-menu']"
    @keydown.escape.window="close()"
    @click.outside="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative inline-block']) }}
>
    {{ $slot }}
</div>

