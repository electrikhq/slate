@props(['as' => 'div'])

<{{ $as }}
    data-slot="carousel-item"
    {{ $attributes->merge(['class' => 'min-w-0 shrink-0 grow-0 basis-full']) }}
>
    {{ $slot }}
</{{ $as }}>
