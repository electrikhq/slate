@props([
    'as' => 'ol',
])

<{{ $as }}
    data-slot="breadcrumb-list"
    {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-1.5 text-sm break-words text-muted-foreground sm:gap-2.5']) }}
>
    {{ $slot }}
</{{ $as }}>
