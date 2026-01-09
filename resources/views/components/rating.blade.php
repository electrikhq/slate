{{-- rating.blade.php --}}
@props([
    'value' => 0,
    'max' => 5,
    'readonly' => false,
    'size' => 'md', // sm, md, lg
    'showValue' => false,
])

@php
    $sizeClasses = [
        'sm' => 'h-4 w-4',
        'md' => 'h-5 w-5',
        'lg' => 'h-6 w-6',
    ][$size];
    
    $value = min(max((float) $value, 0), $max);
@endphp

<div
    x-data="{
        value: {{ $value }},
        max: {{ $max }},
        hoverValue: null,
        setValue(newValue) {
            if (!{{ $readonly ? 'true' : 'false' }}) {
                this.value = newValue;
                this.$dispatch('rating-changed', { value: newValue });
            }
        },
        setHoverValue(newValue) {
            if (!{{ $readonly ? 'true' : 'false' }}) {
                this.hoverValue = newValue;
            }
        },
        clearHover() {
            this.hoverValue = null;
        },
        getDisplayValue() {
            return this.hoverValue !== null ? this.hoverValue : this.value;
        }
    }"
    class="inline-flex items-center gap-2"
    {{ $attributes }}
>
    <div 
        class="flex items-center gap-0.5"
        @mouseleave="clearHover()"
    >
        <template x-for="index in Array.from({length: max}, (_, i) => i + 1)" :key="index">
            <button
                type="button"
                @if($readonly) disabled @endif
                @click="setValue(index)"
                @mouseenter="setHoverValue(index)"
                :class="{
                    'text-primary': index <= getDisplayValue(),
                    'text-muted': index > getDisplayValue()
                }"
                class="transition-colors {{ $sizeClasses }} {{ $readonly ? 'cursor-default' : 'cursor-pointer hover:scale-110' }}"
                :aria-label="'Rate ' + index + ' out of ' + max"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="100%"
                    height="100%"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    stroke="none"
                >
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
            </button>
        </template>
    </div>
    @if($showValue)
        <span class="text-sm text-muted-foreground" x-text="value.toFixed(1)"></span>
    @endif
</div>

