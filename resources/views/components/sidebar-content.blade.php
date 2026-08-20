@props(['as' => 'div'])

<{{ $as }}
    data-slot="sidebar-content"
    {{ $attributes->merge(['class' => 'flex min-h-0 flex-1 flex-col gap-2 overflow-auto p-2']) }}
>
    {{ $slot }}
</{{ $as }}>
