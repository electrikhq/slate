{{-- radio-group-item.blade.php --}}
@props([
    'value' => null,
    'disabled' => false,
    'id' => 'radio-item-' . uniqid(),
])

@php
    $itemValue = $value ?? trim(strip_tags($slot->toHtml()));
    $inputId = 'radio-input-' . uniqid();
@endphp

<div
    x-data="{
        itemValue: @js($itemValue),
        isDisabled: @js($disabled),
        get radioGroupData() {
            let parent = this.$el.closest('[x-data]');
            while (parent && parent !== document.body) {
                if (parent.__x && parent.__x.$data && parent.__x.$data.setValue !== undefined) {
                    return parent.__x.$data;
                }
                parent = parent.parentElement;
            }
            return null;
        },
        get isChecked() {
            const data = this.radioGroupData;
            if (!data) return false;
            return data.value === this.itemValue;
        },
        select() {
            const data = this.radioGroupData;
            if (data && data.setValue && !this.isDisabled) {
                data.setValue(this.itemValue);
            }
        }
    }"
    @click="select()"
    role="radio"
    :aria-checked="isChecked"
    :aria-disabled="isDisabled"
    id="{{ $id }}"
    {{ $attributes->merge([
        'class' => 'flex items-center space-x-2'
    ]) }}
    :class="isDisabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'"
>
    <button
        type="button"
        role="radio"
        :aria-checked="isChecked"
        :disabled="isDisabled"
        class="aspect-square h-4 w-4 rounded-full border text-primary ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        :class="isChecked ? 'border-primary' : 'border-input'"
    >
        <span
            class="flex items-center justify-center"
            :class="isChecked ? 'block' : 'hidden'"
        >
            <span class="h-2.5 w-2.5 rounded-full bg-primary"></span>
        </span>
    </button>
    <label
        for="{{ $inputId }}"
        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
        :class="isDisabled ? 'cursor-not-allowed opacity-70' : 'cursor-pointer'"
    >
        {{ $slot }}
    </label>
    <input
        type="radio"
        :name="radioGroupData?.name || ''"
        value="{{ $itemValue }}"
        id="{{ $inputId }}"
        :checked="isChecked"
        :disabled="isDisabled"
        class="sr-only"
        x-ref="radioInput"
    />
</div>

