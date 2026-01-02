{{-- drawer-content.blade.php --}}
@props([
    'side' => 'left', // left | right | top | bottom
    'size' => 'md', // sm | md | lg
])

@php
    // Size classes based on side
    $sizeClasses = [
        'left' => [
            'sm' => 'w-64',
            'md' => 'w-80',
            'lg' => 'w-96',
        ],
        'right' => [
            'sm' => 'w-64',
            'md' => 'w-80',
            'lg' => 'w-96',
        ],
        'top' => [
            'sm' => 'h-64',
            'md' => 'h-80',
            'lg' => 'h-96',
        ],
        'bottom' => [
            'sm' => 'h-64',
            'md' => 'h-80',
            'lg' => 'h-96',
        ],
    ];
    
    $sizeClass = $sizeClasses[$side][$size] ?? $sizeClasses[$side]['md'];
    
    // Position and animation classes
    $positionClasses = [
        'left' => 'left-0 top-0 h-full border-r',
        'right' => 'right-0 top-0 h-full border-l',
        'top' => 'top-0 left-0 w-full border-b',
        'bottom' => 'bottom-0 left-0 w-full border-t',
    ];
    
    $positionClass = $positionClasses[$side] ?? $positionClasses['left'];
    
    // Slide animation classes
    $enterStart = [
        'left' => '-translate-x-full',
        'right' => 'translate-x-full',
        'top' => '-translate-y-full',
        'bottom' => 'translate-y-full',
    ];
    
    $enterEnd = [
        'left' => 'translate-x-0',
        'right' => 'translate-x-0',
        'top' => 'translate-y-0',
        'bottom' => 'translate-y-0',
    ];
    
    $enterStartClass = $enterStart[$side] ?? $enterStart['left'];
    $enterEndClass = $enterEnd[$side] ?? $enterEnd['left'];
@endphp

<div
    x-show="open"
    x-cloak
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="{{ $enterStartClass }}"
    x-transition:enter-end="{{ $enterEndClass }}"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="{{ $enterEndClass }}"
    x-transition:leave-end="{{ $enterStartClass }}"
    @click.stop
    role="dialog"
    aria-modal="true"
    class="fixed {{ $positionClass }} border-border z-50 {{ $sizeClass }} bg-background text-foreground shadow-lg ring-offset-background flex flex-col"
>
    {{ $slot }}
</div>

