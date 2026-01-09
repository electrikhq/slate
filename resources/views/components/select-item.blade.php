{{-- select-item.blade.php --}}
@props([
    'value' => null,
    'disabled' => false,
])

@php
    $itemValue = $value ?? $slot->toHtml();
@endphp

<div
    data-select-option
    data-value="{{ $itemValue }}"
    x-data="{
        isDisabled: @js($disabled),
        get selectData() {
            let parent = this.$el.closest('[data-select-component]');
            if (parent && parent.__x && parent.__x.$data) {
                return parent.__x.$data;
            }
            return null;
        },
        selectItem() {
            if (!this.isDisabled && this.selectData) {
                this.selectData.select(this.$el);
            }
        },
        get isSelected() {
            if (!this.selectData) return false;
            return this.selectData.selectedOption === this.$el;
        }
    }"
    @click="selectItem()"
    @if($disabled) data-disabled="true" @endif
    :class="{
        'bg-accent text-accent-foreground': isSelected,
        'opacity-50 pointer-events-none': isDisabled
    }"
    class="relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
    {{ $attributes->except(['value', 'disabled']) }}
>
    {{ $slot }}
</div>

