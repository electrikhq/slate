{{-- navigation-menu-link.blade.php --}}
@props([
    'href' => '#',
    'active' => false,
    'variant' => 'default', // default, link
])

@php
    $variantClasses = [
        'default' => 'group inline-flex h-9 w-max items-center justify-center rounded-md bg-background px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-none disabled:pointer-events-none disabled:opacity-50 data-[active]:bg-accent data-[active]:text-accent-foreground',
        'link' => 'group inline-flex h-9 w-max items-center justify-center px-3 text-sm font-medium text-foreground transition-colors hover:text-foreground hover:underline focus:text-foreground focus:underline focus:outline-none disabled:pointer-events-none disabled:opacity-50 data-[active]:text-foreground data-[active]:underline',
    ];
    
    $classes = $variantClasses[$variant] ?? $variantClasses['default'];
@endphp

<a
    href="{{ $href }}"
    @if($active) data-active="true" @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</a>

