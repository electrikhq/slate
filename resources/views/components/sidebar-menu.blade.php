@props(['as' => 'ul'])

<{{ $as }}
    data-slot="sidebar-menu"
    {{ $attributes->merge(['class' => 'flex w-full min-w-0 flex-col gap-1']) }}
>
    {{ $slot }}
</{{ $as }}>
