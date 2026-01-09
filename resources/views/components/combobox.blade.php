{{-- combobox.blade.php --}}
@props([
    'id' => 'combobox-' . uniqid(),
])

<div
    x-data="{
        open: false,
        search: '',
        selectedValue: null,
        selectedLabel: '',
        id: '{{ $id }}',
        close() {
            this.open = false;
        },
        select(value, label) {
            this.selectedValue = value;
            this.selectedLabel = label;
            this.open = false;
            this.search = '';
        }
    }"
    x-id="['combobox']"
    @keydown.escape.window="close()"
    @click.outside="close()"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative']) }}
>
    {{ $slot }}
</div>

