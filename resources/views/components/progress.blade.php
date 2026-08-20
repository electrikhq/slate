@props([
    'value' => 0,
    'max' => 100,
    'as' => 'div',
])

@php
    $resolvedMax = max(1, (float) $max);
    $resolvedValue = max(0, min((float) $value, $resolvedMax));
    $percent = ($resolvedValue / $resolvedMax) * 100;
@endphp

<{{ $as }}
    data-slot="progress"
    role="progressbar"
    aria-valuemin="0"
    aria-valuemax="{{ $resolvedMax }}"
    aria-valuenow="{{ $resolvedValue }}"
    {{ $attributes->merge(['class' => 'relative h-2 w-full overflow-hidden rounded-full bg-primary/20']) }}
>
    <div
        data-slot="progress-indicator"
        class="h-full bg-primary transition-all"
        style="width: {{ $percent }}%"
    ></div>
</{{ $as }}>
