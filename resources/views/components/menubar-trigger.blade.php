{{-- menubar-trigger.blade.php --}}
@props([
    'value' => null,
])

@php
    $menuId = $value ?? 'menu-' . uniqid();
@endphp

<button
    type="button"
    @click="setOpen(openMenu === '{{ $menuId }}' ? null : '{{ $menuId }}')"
    :aria-expanded="openMenu === '{{ $menuId }}'"
    aria-haspopup="true"
    {{ $attributes->merge([
        'class' => 'flex cursor-default select-none items-center rounded-sm px-3 py-1.5 text-sm font-medium outline-none focus:bg-accent focus:text-accent-foreground data-[state=open]:bg-accent data-[state=open]:text-accent-foreground'
    ]) }}
    :data-state="openMenu === '{{ $menuId }}' ? 'open' : 'closed'"
>
    {{ $slot }}
</button>

