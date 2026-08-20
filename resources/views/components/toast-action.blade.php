@props(['as' => 'div'])

<{{ $as }}
    data-slot="toast-action"
    {{ $attributes->merge(['class' => 'shrink-0']) }}
>
    {{ $slot }}
</{{ $as }}>
