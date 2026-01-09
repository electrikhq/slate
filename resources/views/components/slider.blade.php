{{-- slider.blade.php --}}
@props([
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => null,
    'defaultValue' => null,
    'disabled' => false,
    'name' => null,
    'id' => 'slider-' . uniqid(),
])

@php
    $initialValue = $value ?? $defaultValue ?? $min;
@endphp

<div
    x-data="{
        value: {{ $initialValue }},
        min: {{ $min }},
        max: {{ $max }},
        step: {{ $step }},
        isDragging: false,
        startX: 0,
        startValue: 0,
        handleMouseMoveEvent: null,
        handleMouseUpEvent: null,
        
        init() {
            this.handleMouseMoveEvent = this.handleMouseMove.bind(this);
            this.handleMouseUpEvent = this.handleMouseUp.bind(this);
        },
        
        get percentage() {
            return ((this.value - this.min) / (this.max - this.min)) * 100;
        },
        
        handleMouseDown(event) {
            if ({{ $disabled ? 'true' : 'false' }}) return;
            this.isDragging = true;
            this.startX = event.clientX;
            this.startValue = this.value;
            document.addEventListener('mousemove', this.handleMouseMoveEvent);
            document.addEventListener('mouseup', this.handleMouseUpEvent);
            event.preventDefault();
        },
        
        handleMouseMove(event) {
            if (!this.isDragging) return;
            const slider = this.$el;
            const rect = slider.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const percentage = Math.max(0, Math.min(100, (x / rect.width) * 100));
            const newValue = this.min + (percentage / 100) * (this.max - this.min);
            this.value = Math.round(newValue / this.step) * this.step;
            this.value = Math.max(this.min, Math.min(this.max, this.value));
            this.$dispatch('change', { value: this.value });
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = this.value;
            }
        },
        
        handleMouseUp() {
            this.isDragging = false;
            document.removeEventListener('mousemove', this.handleMouseMoveEvent);
            document.removeEventListener('mouseup', this.handleMouseUpEvent);
        },
        
        handleClick(event) {
            if (this.isDragging) return;
            const slider = this.$el;
            const rect = slider.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const percentage = Math.max(0, Math.min(100, (x / rect.width) * 100));
            const newValue = this.min + (percentage / 100) * (this.max - this.min);
            this.value = Math.round(newValue / this.step) * this.step;
            this.value = Math.max(this.min, Math.min(this.max, this.value));
            this.$dispatch('change', { value: this.value });
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = this.value;
            }
        }
    }"
    @mousedown="handleMouseDown($event)"
    @click="handleClick($event)"
    id="{{ $id }}"
    role="slider"
    :aria-valuemin="{{ $min }}"
    :aria-valuemax="{{ $max }}"
    :aria-valuenow="value"
    :aria-disabled="{{ $disabled ? 'true' : 'false' }}"
    tabindex="{{ $disabled ? '-1' : '0' }}"
    {{ $attributes->merge([
        'class' => 'relative flex w-full touch-none select-none items-center'
    ]) }}
    :class="{{ $disabled ? "'opacity-50 cursor-not-allowed'" : "'cursor-pointer'" }}"
>
    <div class="relative h-2 w-full grow overflow-hidden rounded-full bg-secondary">
        <div
            class="absolute h-full bg-primary"
            :style="`width: ${percentage}%`"
        ></div>
    </div>
    <div
        class="absolute h-5 w-5 -translate-x-1/2 rounded-full border-2 border-primary bg-background ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
        :style="`left: ${percentage}%`"
    ></div>
    @if($name)
        <input
            type="hidden"
            name="{{ $name }}"
            :value="value"
            x-ref="hiddenInput"
        />
    @endif
</div>
