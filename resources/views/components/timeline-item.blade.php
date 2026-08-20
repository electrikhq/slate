@props(['as' => 'div'])

<{{ $as }}
    data-slot="timeline-item"
    {{ $attributes->merge(['class' => 'relative grid gap-4 ps-8 before:absolute before:start-3 before:top-0 before:h-full before:w-px before:bg-border last:before:hidden']) }}
>
    {{ $slot }}
</{{ $as }}>
