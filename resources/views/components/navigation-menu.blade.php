{{-- navigation-menu.blade.php --}}
@props([
    'id' => 'navigation-menu-' . uniqid(),
])

<nav
    x-data="{
        activeItem: null,
        id: '{{ $id }}',
        setActive(item) {
            this.activeItem = item;
        },
        clearActive() {
            this.activeItem = null;
        }
    }"
    x-id="['navigation-menu']"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</nav>

