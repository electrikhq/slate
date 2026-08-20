@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="context-menu-trigger"
    @contextmenu="show($event)"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
