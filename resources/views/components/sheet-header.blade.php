@props(['as' => 'div'])

<{{ $as }}
    data-slot="sheet-header"
    {{ $attributes->merge(['class' => 'flex flex-col gap-1.5 p-4']) }}
>
    {{ $slot }}
</{{ $as }}>
