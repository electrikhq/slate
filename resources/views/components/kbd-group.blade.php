@props([
    'as' => 'kbd',
])

<{{ $as }}
    data-slot="kbd-group"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1']) }}
>
    {{ $slot }}
</{{ $as }}>
