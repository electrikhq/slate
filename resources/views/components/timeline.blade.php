@props(['as' => 'div'])

<{{ $as }}
    data-slot="timeline"
    {{ $attributes->merge(['class' => 'relative grid gap-6']) }}
>
    {{ $slot }}
</{{ $as }}>
