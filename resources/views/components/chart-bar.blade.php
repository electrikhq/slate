@props([
    'label' => null,
    'value' => 0,
    'max' => null,
    'as' => 'div',
])

@php
    $barValue = (float) $value;
    $barMax = $max !== null ? (float) $max : max($barValue, 1);
    $height = round(($barValue / $barMax) * 100);
@endphp

<{{ $as }}
    data-slot="chart-bar"
    {{ $attributes->merge(['class' => 'flex flex-1 flex-col items-center gap-2']) }}
>
    <div
        class="w-full rounded-t-sm bg-primary transition-all"
        style="height: {{ max(4, $height) }}%"
        @if(filled($label)) title="{{ $label }}: {{ $barValue }}" @endif
    ></div>
    @if(filled($label))
        <span class="text-xs text-muted-foreground">{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
