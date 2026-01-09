{{-- dropdown-menu-item.blade.php --}}
@props([
    'disabled' => false,
    'inset' => false,
])

@php
    $baseClasses = 'relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50';
    $insetClasses = $inset ? 'pl-8' : '';
    $disabledClasses = $disabled ? 'pointer-events-none opacity-50' : '';
@endphp

@php
    $clickHandler = $disabled ? '' : '@click="close()"';
@endphp

<div
    role="menuitem"
    {!! $clickHandler !!}
    @click.stop
    {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $insetClasses . ' ' . $disabledClasses)]) }}
    @if($disabled) data-disabled="true" @endif
>
    {{ $slot }}
</div>

