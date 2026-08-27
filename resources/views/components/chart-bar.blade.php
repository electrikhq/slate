@props([
    'label' => null,
    'value' => 0,
    'max' => null,
    'as' => 'div',
])

@php
    $barValue = (float) $value;
    $barMax = $max !== null ? (float) $max : max($barValue, 1);
    $barMax = $barMax > 0 ? $barMax : 1;
    $height = round(($barValue / $barMax) * 100);
@endphp

<{{ $as }}
    data-slot="chart-bar"
    {{ $attributes->merge(['class' => 'flex h-full min-h-0 flex-1 flex-col gap-2']) }}
>
    <div class="relative min-h-0 w-full flex-1">
        <div
            class="absolute inset-x-0 bottom-0 rounded-t-sm bg-primary transition-[height]"
            style="height: {{ max(4, $height) }}%"
            @if(filled($label)) title="{{ $label }}: {{ $barValue }}" @endif
        ></div>
    </div>
    @if(filled($label))
        <span class="shrink-0 text-center text-xs text-muted-foreground">{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
