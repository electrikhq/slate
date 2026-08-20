@props(['as' => 'div'])

<{{ $as }}
    data-slot="sheet-footer"
    {{ $attributes->merge(['class' => 'mt-auto flex flex-col gap-2 p-4']) }}
>
    {{ $slot }}
</{{ $as }}>
