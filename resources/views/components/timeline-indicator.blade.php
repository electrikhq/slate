@props(['as' => 'div'])

<{{ $as }}
    data-slot="timeline-indicator"
    {{ $attributes->merge(['class' => 'absolute start-0 top-1 flex size-6 items-center justify-center rounded-full border bg-background']) }}
>
    {{ $slot }}
</{{ $as }}>
