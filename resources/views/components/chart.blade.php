@props([
    'data' => null,
    'max' => null,
    'label' => null,
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
    $ariaLabel = $label ?? $attributes->get('aria-label') ?? 'Bar chart';
@endphp

<{{ $as }}
    data-slot="chart"
    role="img"
    aria-label="{{ $ariaLabel }}"
    {{ $attributes->except(['aria-label'])->merge(['class' => 'flex h-48 w-full items-stretch gap-2 rounded-md border bg-background p-4']) }}
>
    @if(! empty($chartData))
        @foreach($chartData as $index => $item)
            @php
                $itemLabel = is_array($item) ? ($item['label'] ?? '') : (string) $index;
                $value = is_array($item) ? ($item['value'] ?? 0) : (int) $item;
                $height = round(($value / $resolvedMax) * 100);
            @endphp
            <div data-slot="chart-bar" class="flex h-full min-h-0 flex-1 flex-col gap-2">
                <div class="relative min-h-0 w-full flex-1">
                    <div
                        class="absolute inset-x-0 bottom-0 rounded-t-sm bg-primary transition-[height]"
                        style="height: {{ max(4, $height) }}%"
                        title="{{ $itemLabel }}: {{ $value }}"
                    ></div>
                </div>
                @if(filled($itemLabel))
                    <span class="shrink-0 text-center text-xs text-muted-foreground" aria-hidden="true">{{ $itemLabel }}</span>
                @endif
            </div>
        @endforeach
        <table class="sr-only">
            <caption>{{ $ariaLabel }}</caption>
            <thead>
                <tr>
                    <th scope="col">Label</th>
                    <th scope="col">Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chartData as $index => $item)
                    @php
                        $itemLabel = is_array($item) ? ($item['label'] ?? (string) $index) : (string) $index;
                        $value = is_array($item) ? ($item['value'] ?? 0) : (int) $item;
                    @endphp
                    <tr>
                        <td>{{ $itemLabel }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
