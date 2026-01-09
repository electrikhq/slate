{{-- hover-card-content.blade.php --}}
@props([
    'align' => 'center', // start | center | end
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
    
    // Positioning classes based on side and align
    $positionClasses = [
        'top' => [
            'start' => 'bottom-full left-0' . ($offsetClass ? ' mb-' . $offsetClass : ''),
            'center' => 'bottom-full left-1/2 -translate-x-1/2' . ($offsetClass ? ' mb-' . $offsetClass : ''),
            'end' => 'bottom-full right-0' . ($offsetClass ? ' mb-' . $offsetClass : ''),
        ],
        'bottom' => [
            'start' => 'top-full left-0' . ($offsetClass ? ' mt-' . $offsetClass : ''),
            'center' => 'top-full left-1/2 -translate-x-1/2' . ($offsetClass ? ' mt-' . $offsetClass : ''),
            'end' => 'top-full right-0' . ($offsetClass ? ' mt-' . $offsetClass : ''),
        ],
        'left' => [
            'start' => 'right-full top-0' . ($offsetClass ? ' mr-' . $offsetClass : ''),
            'center' => 'right-full top-1/2 -translate-y-1/2' . ($offsetClass ? ' mr-' . $offsetClass : ''),
            'end' => 'right-full bottom-0' . ($offsetClass ? ' mr-' . $offsetClass : ''),
        ],
        'right' => [
            'start' => 'left-full top-0' . ($offsetClass ? ' ml-' . $offsetClass : ''),
            'center' => 'left-full top-1/2 -translate-y-1/2' . ($offsetClass ? ' ml-' . $offsetClass : ''),
            'end' => 'left-full bottom-0' . ($offsetClass ? ' ml-' . $offsetClass : ''),
        ],
    ];
    
    $positionClass = $positionClasses[$side][$align] ?? $positionClasses['top']['center'];
    
    // Animation classes
    $enterStart = [
        'top' => 'opacity-0 -translate-y-1',
        'bottom' => 'opacity-0 translate-y-1',
        'left' => 'opacity-0 -translate-x-1',
        'right' => 'opacity-0 translate-x-1',
    ];
    
    $enterEnd = [
        'top' => 'opacity-100 translate-y-0',
        'bottom' => 'opacity-100 translate-y-0',
        'left' => 'opacity-100 translate-x-0',
        'right' => 'opacity-100 translate-x-0',
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
    class="absolute z-50 w-64 rounded-md border border-border bg-popover text-popover-foreground shadow-md p-4 {{ $positionClass }}"
>
    {{ $slot }}
</div>

