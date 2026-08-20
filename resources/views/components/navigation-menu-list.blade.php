@props(['as' => 'ul'])

<{{ $as }}
    data-slot="navigation-menu-list"
    {{ $attributes->merge(['class' => 'group flex flex-1 list-none items-center justify-center gap-1']) }}
>
    {{ $slot }}
</{{ $as }}>
