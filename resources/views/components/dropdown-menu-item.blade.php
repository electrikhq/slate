@props([
    'inset' => false,
    'variant' => 'default',
    'as' => 'div',
])

@php
    $isInset = filter_var($inset, FILTER_VALIDATE_BOOL);
    $resolvedVariant = in_array($variant, ['default', 'destructive'], true) ? $variant : 'default';

    $classes = trim(implode(' ', [
        'relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none',
        'hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
        'data-[disabled]:pointer-events-none data-[disabled]:opacity-50',
        '[&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0',
        $isInset ? 'ps-8' : '',
        $resolvedVariant === 'destructive'
            ? 'text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive'
            : '',
    ]));
@endphp

<{{ $as }}
    data-slot="dropdown-menu-item"
    role="menuitem"
    @click="open = false"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
