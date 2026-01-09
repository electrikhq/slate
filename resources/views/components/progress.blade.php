{{-- progress.blade.php --}}
@props([
    'value' => 0, // Progress value (0-100 or 0-max)
    'max' => 100, // Maximum value
    'size' => 'default', // sm, default, lg
    'showLabel' => false, // Show percentage label
    'label' => null, // Custom label text
])

@php
    // Ensure value is within bounds
    $progressValue = max(0, min($max, (float)$value));
    $percentage = ($max > 0) ? ($progressValue / $max) * 100 : 0;
    $percentage = round($percentage, 1);
    
    // Size classes for height
    $sizeClasses = [
        'sm' => 'h-1',
        'default' => 'h-2',
        'lg' => 'h-4',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['default'];
    
    // Generate ID for ARIA
    $progressId = $attributes->get('id', 'progress-' . uniqid());
    
    // Build label text
    $labelText = $label ?? ($showLabel ? "{$percentage}%" : null);
@endphp

<div
    {{ $attributes->merge(['class' => 'relative w-full overflow-hidden rounded-full bg-secondary ' . $sizeClass]) }}
    role="progressbar"
    aria-valuenow="{{ $progressValue }}"
    aria-valuemin="0"
    aria-valuemax="{{ $max }}"
    @if($progressId) id="{{ $progressId }}" @endif
>
    <div
        class="h-full bg-primary transition-all duration-300"
        style="width: {{ $percentage }}%"
    ></div>
    @if($labelText)
        <div class="absolute inset-0 flex items-center justify-center text-xs font-medium text-primary-foreground">
            {{ $labelText }}
        </div>
    @endif
</div>

