@props(['as' => 'div'])

<{{ $as }}
    data-slot="drawer-footer"
    {{ $attributes->merge(['class' => 'mt-auto flex flex-col gap-2 p-4']) }}
>
    {{ $slot }}
</{{ $as }}>
