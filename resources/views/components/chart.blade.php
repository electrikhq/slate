@props([
    'data' => null,
    'max' => null,
    'as' => 'div',
])

@php
    $chartData = [];

    if (is_string($data)) {
        $decoded = json_decode($data, true);
        $chartData = is_array($decoded) ? $decoded : [];
    } elseif (is_array($data)) {
        $chartData = $data;
    }

    $values = array_map(fn ($item) => is_array($item) ? ($item['value'] ?? 0) : (int) $item, $chartData);
    $resolvedMax = $max !== null ? (float) $max : (max($values ?: [1]));
    $resolvedMax = $resolvedMax > 0 ? $resolvedMax : 1;
@endphp

<{{ $as }}
    data-slot="chart"
    role="img"
    {{ $attributes->merge(['class' => 'flex h-48 w-full items-end gap-2 rounded-md border bg-background p-4']) }}
>
    @if(! empty($chartData))
        @foreach($chartData as $index => $item)
            @php
                $label = is_array($item) ? ($item['label'] ?? '') : (string) $index;
                $value = is_array($item) ? ($item['value'] ?? 0) : (int) $item;
                $height = round(($value / $resolvedMax) * 100);
            @endphp
            <div data-slot="chart-bar" class="flex flex-1 flex-col items-center gap-2">
                <div
                    class="w-full rounded-t-sm bg-primary transition-all"
                    style="height: {{ max(4, $height) }}%"
                    title="{{ $label }}: {{ $value }}"
                ></div>
                @if(filled($label))
                    <span class="text-xs text-muted-foreground">{{ $label }}</span>
                @endif
            </div>
        @endforeach
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
