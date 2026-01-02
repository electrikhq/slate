{{-- tooltip-content.blade.php --}}
@props([
    'side' => 'top', // top | bottom | left | right
    'sideOffset' => 4, // Distance from trigger in pixels
])

@php
    // Convert sideOffset to Tailwind spacing (4px = 1, so divide by 4)
    $offsetClass = match($sideOffset) {
        0 => '',
        4 => '1',
        8 => '2',
        12 => '3',
        16 => '4',
        default => '1',
    };
    
    // Positioning classes based on side
    $positionClasses = [
        'top' => 'bottom-full left-1/2 -translate-x-1/2' . ($offsetClass ? ' mb-' . $offsetClass : ''),
        'bottom' => 'top-full left-1/2 -translate-x-1/2' . ($offsetClass ? ' mt-' . $offsetClass : ''),
        'left' => 'right-full top-1/2 -translate-y-1/2' . ($offsetClass ? ' mr-' . $offsetClass : ''),
        'right' => 'left-full top-1/2 -translate-y-1/2' . ($offsetClass ? ' ml-' . $offsetClass : ''),
    ];
    
    $positionClass = $positionClasses[$side] ?? $positionClasses['top'];
    
    // Animation classes (centered positioning already handled by position classes)
    $enterStart = [
        'top' => 'opacity-0 scale-95',
        'bottom' => 'opacity-0 scale-95',
        'left' => 'opacity-0 scale-95',
        'right' => 'opacity-0 scale-95',
    ];
    
    $enterEnd = [
        'top' => 'opacity-100 scale-100',
        'bottom' => 'opacity-100 scale-100',
        'left' => 'opacity-100 scale-100',
        'right' => 'opacity-100 scale-100',
    ];
    
    $enterStartClass = $enterStart[$side] ?? $enterStart['top'];
    $enterEndClass = $enterEnd[$side] ?? $enterEnd['top'];
@endphp

<div
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="{{ $enterStartClass }}"
    x-transition:enter-end="{{ $enterEndClass }}"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="{{ $enterEndClass }}"
    x-transition:leave-end="{{ $enterStartClass }}"
    role="tooltip"
    class="absolute z-50 rounded-md border border-border bg-primary text-primary-foreground px-3 py-1.5 text-xs font-medium shadow-md pointer-events-none whitespace-nowrap {{ $positionClass }}"
>
    {{ $slot }}
</div>

