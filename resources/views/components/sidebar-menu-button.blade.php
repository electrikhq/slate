@props([
    'active' => false,
    'as' => 'a',
    'href' => '#',
])

@php
    $isActive = filter_var($active, FILTER_VALIDATE_BOOL);
    $classes = trim('peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-start text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground');
@endphp

@if($as === 'a')
<a
    href="{{ $href }}"
    data-slot="sidebar-menu-button"
    data-active="{{ $isActive ? 'true' : 'false' }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</a>
@else
<{{ $as }}
    data-slot="sidebar-menu-button"
    data-active="{{ $isActive ? 'true' : 'false' }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
@endif
