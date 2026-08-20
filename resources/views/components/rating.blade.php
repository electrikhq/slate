@props([
    'value' => 0,
    'max' => 5,
    'readonly' => false,
    'name' => null,
    'label' => null,
])

@php
    $resolvedMax = max(1, (int) $max);
    $initial = max(0, min($resolvedMax, (int) $value));
    $isReadonly = filter_var($readonly, FILTER_VALIDATE_BOOL);
    $resolvedName = $name ?? $attributes->get('name');
@endphp

<div
    data-slot="rating"
    role="radiogroup"
    @if(filled($label)) aria-label="{{ $label }}" @endif
    x-data="{ value: {{ $initial }}, max: {{ $resolvedMax }}, readonly: {{ $isReadonly ? 'true' : 'false' }} }"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-0.5']) }}
>
    @if($resolvedName)
        <input type="hidden" name="{{ $resolvedName }}" x-bind:value="value" />
    @endif

    @for($star = 1; $star <= $resolvedMax; $star++)
        <button
            type="button"
            data-slot="rating-star"
            role="radio"
            aria-label="{{ $star }} of {{ $resolvedMax }}"
            x-bind:aria-checked="value >= {{ $star }} ? 'true' : 'false'"
            @click="if (!readonly) value = {{ $star }}"
            @keydown.arrow-right.prevent="if (!readonly) value = Math.min(max, value + 1)"
            @keydown.arrow-left.prevent="if (!readonly) value = Math.max(0, value - 1)"
            class="rounded-xs p-0.5 text-muted-foreground transition-colors hover:text-foreground focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring disabled:pointer-events-none"
            x-bind:class="value >= {{ $star }} ? 'text-primary' : ''"
        >
            <svg viewBox="0 0 24 24" fill="currentColor" class="size-5" aria-hidden="true">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
        </button>
    @endfor
</div>
