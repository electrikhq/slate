@props([
    'open' => false,
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-dialog"
    @include('slate::components.partials.overlay-root-attrs', ['open' => $open])
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
