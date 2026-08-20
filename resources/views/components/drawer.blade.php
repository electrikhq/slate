@props([
    'open' => false,
    'as' => 'div',
])

<{{ $as }}
    data-slot="drawer"
    @include('slate::components.partials.overlay-root-attrs', ['open' => $open])
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
