{{-- pagination-link.blade.php --}}
@props([
    'href' => '#',
    'active' => false,
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';
    $activeClasses = $active ? 'bg-background text-foreground shadow' : 'hover:bg-accent hover:text-accent-foreground';
    $sizeClasses = 'h-10 w-10';
    $disabledClasses = $disabled ? 'pointer-events-none opacity-50' : '';
@endphp

<a
    href="{{ $href }}"
    @if($active) aria-current="page" @endif
    @if($disabled) aria-disabled="true" @endif
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $activeClasses . ' ' . $sizeClasses . ' ' . $disabledClasses)]) }}
>
    {{ $slot }}
</a>

