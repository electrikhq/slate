{{-- menubar.blade.php --}}
@props([
    'id' => 'menubar-' . uniqid(),
])

<div
    x-data="{
        openMenu: null,
        id: '{{ $id }}',
        setOpen(menu) {
            this.openMenu = menu;
        },
        closeMenu() {
            this.openMenu = null;
        }
    }"
    x-id="['menubar']"
    @keydown.escape.window="closeMenu()"
    @click.outside="closeMenu()"
    wire:ignore
    {{ $attributes->merge(['class' => 'flex items-center space-x-1 rounded-md border border-border bg-background p-1']) }}
>
    {{ $slot }}
</div>

