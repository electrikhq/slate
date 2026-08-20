@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="card-header"
    {{ $attributes->merge(['class' => '@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-2 px-[var(--card-spacing)] has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-[var(--card-spacing)]']) }}
>
    {{ $slot }}
</{{ $as }}>
