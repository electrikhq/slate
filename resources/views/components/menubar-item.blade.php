@props([
    'inset' => false,
    'as' => 'div',
])

@php
    $isInset = filter_var($inset, FILTER_VALIDATE_BOOL);
@endphp

<{{ $as }}
    data-slot="menubar-item"
    role="menuitem"
    @click="activeMenu = null"
    {{ $attributes->merge(['class' => trim('relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 '.($isInset ? 'ps-8' : ''))]) }}
>
    {{ $slot }}
</{{ $as }}>
