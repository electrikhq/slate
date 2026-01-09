{{-- combobox-content.blade.php --}}
@props([
    'align' => 'start',
    'side' => 'bottom',
    'sideOffset' => 4,
])

@php
    $offsetClass = match($sideOffset) {
        0 => '',
        4 => '1',
        8 => '2',
        12 => '3',
        16 => '4',
        default => '1',
    };
    
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
    ];
    
    $positionClass = $positionClasses[$side][$align] ?? $positionClasses['bottom']['start'];
    
    $enterStart = [
        'top' => 'opacity-0 -translate-y-1',
        'bottom' => 'opacity-0 translate-y-1',
    ];
    
    $enterEnd = [
        'top' => 'opacity-100 translate-y-0',
        'bottom' => 'opacity-100 translate-y-0',
    ];
    
    $enterStartClass = $enterStart[$side] ?? $enterStart['bottom'];
    $enterEndClass = $enterEnd[$side] ?? $enterEnd['bottom'];
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
    @click.stop
    role="listbox"
    class="absolute z-50 w-full min-w-[8rem] overflow-hidden rounded-md border border-border bg-popover text-popover-foreground shadow-md {{ $positionClass }}"
>
    <div class="p-1">
        {{ $slot }}
    </div>
</div>

