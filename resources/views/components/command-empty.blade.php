@props(['as' => 'div'])

<{{ $as }}
    data-slot="command-empty"
    x-show="[...$root.querySelectorAll('[data-slot=command-item]')].every((el) => el.offsetParent === null)"
    x-cloak
    {{ $attributes->merge(['class' => 'py-6 text-center text-sm text-muted-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
