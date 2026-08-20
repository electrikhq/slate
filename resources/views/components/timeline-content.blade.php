@props(['as' => 'div'])

<{{ $as }}
    data-slot="timeline-content"
    {{ $attributes->merge(['class' => 'grid gap-1 pb-6']) }}
>
    {{ $slot }}
</{{ $as }}>
