@props([
    'as' => 'nav',
])

<{{ $as }}
    data-slot="navigation-menu"
    x-data="{ active: null }"
    {{ $attributes->merge(['class' => 'relative z-10 flex max-w-max flex-1 items-center justify-center']) }}
>
    {{ $slot }}
</{{ $as }}>
