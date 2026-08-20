@props(['as' => 'div'])

<{{ $as }}
    data-slot="toast-title"
    {{ $attributes->merge(['class' => 'text-sm font-semibold']) }}
>
    {{ $slot }}
</{{ $as }}>
