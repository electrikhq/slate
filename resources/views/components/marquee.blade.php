{{-- marquee.blade.php --}}
@props([
    'direction' => 'left', // left, right, up, down
    'pauseOnHover' => false,
    'speed' => 'normal', // slow, normal, fast
])

@php
    $speedDurations = [
        'slow' => '60s',
        'normal' => '30s',
        'fast' => '15s',
    ];
    
    $duration = $speedDurations[$speed] ?? $speedDurations['normal'];
    
    $directionAnimations = [
        'left' => 'marquee-left',
        'right' => 'marquee-right',
        'up' => 'marquee-up',
        'down' => 'marquee-down',
    ];
    
    $animationName = $directionAnimations[$direction] ?? $directionAnimations['left'];
    
    $pauseClass = $pauseOnHover ? 'hover:[animation-play-state:paused]' : '';
    
    $isVertical = in_array($direction, ['up', 'down']);
    $flexDirection = $isVertical ? 'flex-col' : 'flex-row';
@endphp

<div
    {{ $attributes->merge([
        'class' => "relative flex w-full overflow-hidden {$pauseClass}"
    ]) }}
>
    <div 
        class="flex shrink-0 gap-4 {$flexDirection}"
        style="animation: {$animationName} {$duration} linear infinite;"
    >
        {{ $slot }}
        {{ $slot }}
    </div>
</div>

