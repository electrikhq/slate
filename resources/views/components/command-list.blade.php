@props(['as' => 'div'])

<{{ $as }}
    data-slot="command-list"
    {{ $attributes->merge(['class' => 'max-h-72 overflow-y-auto overflow-x-hidden p-1']) }}
>
    {{ $slot }}
</{{ $as }}>
