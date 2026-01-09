{{-- sheet-content.blade.php --}}
@props([
    'side' => 'right', // top, right, bottom, left
])

@php
    $sideClasses = [
        'top' => 'inset-x-0 top-0 border-b data-[state=closed]:slide-out-to-top data-[state=open]:slide-in-from-top',
        'right' => 'inset-y-0 right-0 h-full w-3/4 border-l data-[state=closed]:slide-out-to-right data-[state=open]:slide-in-from-right sm:max-w-sm',
        'bottom' => 'inset-x-0 bottom-0 border-t data-[state=closed]:slide-out-to-bottom data-[state=open]:slide-in-from-bottom',
        'left' => 'inset-y-0 left-0 h-full w-3/4 border-r data-[state=closed]:slide-out-to-left data-[state=open]:slide-in-from-left sm:max-w-sm',
    ];
    
    $sideClass = $sideClasses[$side] ?? $sideClasses['right'];
@endphp

<div
    x-show="open"
    x-cloak
    x-transition:enter="transition-transform ease-in-out duration-300"
    x-transition:enter-start="@if($side === 'right') translate-x-full @elseif($side === 'left') -translate-x-full @elseif($side === 'top') -translate-y-full @else translate-y-full @endif"
    x-transition:enter-end="translate-x-0 translate-y-0"
    x-transition:leave="transition-transform ease-in-out duration-300"
    x-transition:leave-start="translate-x-0 translate-y-0"
    x-transition:leave-end="@if($side === 'right') translate-x-full @elseif($side === 'left') -translate-x-full @elseif($side === 'top') -translate-y-full @else translate-y-full @endif"
    @click.away="close()"
    class="fixed z-50 gap-4 bg-background p-6 shadow-lg {{ $sideClass }}"
    role="dialog"
    :aria-modal="open"
    :aria-labelledby="$id('sheet-title')"
    :aria-describedby="$id('sheet-description')"
    {{ $attributes->except(['side']) }}
>
    {{ $slot }}
</div>

