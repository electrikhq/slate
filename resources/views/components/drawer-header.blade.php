@props(['as' => 'div'])

<{{ $as }}
    data-slot="drawer-header"
    {{ $attributes->merge(['class' => 'flex flex-col gap-1.5 p-4 text-center sm:text-start']) }}
>
    {{ $slot }}
</{{ $as }}>
