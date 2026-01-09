{{-- sidebar-menu-button.blade.php --}}
@props([
    'active' => false,
    'as' => 'a',
])

@php
    $baseClasses = 'flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50';
    $activeClasses = $active ? 'bg-accent text-accent-foreground' : '';
@endphp

@if ($as === 'a')
    <a
        {{ $attributes->merge([
            'class' => trim($baseClasses . ' ' . $activeClasses)
        ]) }}
    >
        {{ $slot }}
    </a>
@elseif ($as === 'button')
    <button
        type="button"
        {{ $attributes->merge([
            'class' => trim($baseClasses . ' ' . $activeClasses)
        ]) }}
    >
        {{ $slot }}
    </button>
@else
    <div
        {{ $attributes->merge([
            'class' => trim($baseClasses . ' ' . $activeClasses)
        ]) }}
    >
        {{ $slot }}
    </div>
@endif

