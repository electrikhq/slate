{{-- chart-legend-item.blade.php --}}
@props([
    'color' => 'primary',
    'label' => '',
])

<div
    {{ $attributes->merge([
        'class' => 'flex items-center gap-2'
    ]) }}
>
    <div
        class="h-3 w-3 rounded-full"
        style="background-color: hsl(var(--color-{{ $color }}))"
    ></div>
    @if($label)
        <span class="text-sm text-muted-foreground">{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</div>

