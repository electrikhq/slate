@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="avatar-fallback"
    {{ $attributes->merge(['class' => 'flex size-full items-center justify-center overflow-hidden rounded-full bg-muted text-sm text-muted-foreground group-data-[size=sm]/avatar:text-xs']) }}
>
    {{ $slot }}
</{{ $as }}>
