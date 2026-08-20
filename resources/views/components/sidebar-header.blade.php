@props(['as' => 'div'])

<{{ $as }}
    data-slot="sidebar-header"
    {{ $attributes->merge(['class' => 'flex flex-col gap-2 p-4']) }}
>
    {{ $slot }}
</{{ $as }}>
