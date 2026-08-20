@props([
    'value' => 50,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'name' => null,
    'disabled' => false,
])

@php
    $resolvedMin = (float) $min;
    $resolvedMax = max($resolvedMin + 0.0001, (float) $max);
    $resolvedStep = max(0.0001, (float) $step);
    $resolvedValue = max($resolvedMin, min((float) $value, $resolvedMax));
    $isDisabled = filter_var($disabled, FILTER_VALIDATE_BOOL);
    $percent = (($resolvedValue - $resolvedMin) / ($resolvedMax - $resolvedMin)) * 100;
@endphp

<div
    data-slot="slider"
    x-data="{
        value: {{ $resolvedValue }},
        min: {{ $resolvedMin }},
        max: {{ $resolvedMax }},
        get percent() {
            return ((this.value - this.min) / (this.max - this.min)) * 100
        }
    }"
    {{ $attributes->merge(['class' => 'relative flex h-4 w-full touch-none items-center select-none data-[disabled]:opacity-50']) }}
    @if($isDisabled) data-disabled @endif
>
    <div class="relative h-1.5 w-full grow overflow-hidden rounded-full bg-primary/20">
        <div
            data-slot="slider-range"
            class="absolute h-full bg-primary"
            x-bind:style="`width: ${percent}%`"
            style="width: {{ $percent }}%"
        ></div>
    </div>

    <input
        type="range"
        data-slot="slider-input"
        @if(filled($name)) name="{{ $name }}" @endif
        min="{{ $resolvedMin }}"
        max="{{ $resolvedMax }}"
        step="{{ $resolvedStep }}"
        x-model.number="value"
        @if($isDisabled) disabled @endif
        class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0 disabled:cursor-not-allowed"
        aria-valuemin="{{ $resolvedMin }}"
        aria-valuemax="{{ $resolvedMax }}"
        x-bind:aria-valuenow="value"
    />

    <div
        data-slot="slider-thumb"
        class="pointer-events-none absolute top-1/2 size-4 -translate-y-1/2 rounded-full border border-primary/50 bg-background shadow-sm ring-ring/50 transition-[color,box-shadow] block"
        x-bind:style="`inset-inline-start: calc(${percent}% - 0.5rem)`"
        style="inset-inline-start: calc({{ $percent }}% - 0.5rem)"
    ></div>
</div>
