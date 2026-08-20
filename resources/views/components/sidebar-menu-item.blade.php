@props(['as' => 'li'])

<{{ $as }}
    data-slot="sidebar-menu-item"
    {{ $attributes->merge(['class' => 'group/menu-item relative']) }}
>
    {{ $slot }}
</{{ $as }}>
