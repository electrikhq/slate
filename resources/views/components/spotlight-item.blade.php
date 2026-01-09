{{-- spotlight-item.blade.php --}}
@props([
    'value' => null,
    'disabled' => false,
])

@php
    $itemValue = $value ?? $slot->toHtml();
@endphp

<div
    x-data="{
        get spotlightData() {
            const spotlight = this.$el.closest('[x-data]');
            return spotlight && spotlight.__x ? spotlight.__x.$data : null;
        },
        get index() {
            const data = this.spotlightData;
            if (!data || !data.items) return -1;
            return data.items.indexOf(this.$el);
        },
        get isSelected() {
            const data = this.spotlightData;
            return data && data.selectedIndex === this.index;
        },
        select() {
            const data = this.spotlightData;
            if (data && data.selectItem) {
                data.selectItem(this.index);
            }
        }
    }"
    data-spotlight-item
    @click="select()"
    @if($disabled) data-disabled="true" @endif
    :class="{
        'bg-accent text-accent-foreground': isSelected,
        'opacity-50 pointer-events-none': {{ $disabled ? 'true' : 'false' }}
    }"
    class="relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
    {{ $attributes->except(['value', 'disabled']) }}
>
    {{ $slot }}
</div>

