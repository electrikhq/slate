@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="dropdown-menu-separator"
    role="separator"
    {{ $attributes->merge(['class' => '-mx-1 my-1 h-px bg-border']) }}
>
</{{ $as }}>
