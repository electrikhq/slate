@props(['as' => 'div'])

<{{ $as }}
    data-slot="carousel-content"
    class="overflow-hidden"
    {{ $attributes }}
>
    <div
        x-ref="track"
        class="flex transition-transform duration-300 ease-in-out [transform:translateX(calc(var(--carousel-index)*-100%))] rtl:[transform:translateX(calc(var(--carousel-index)*100%))]"
        x-bind:style="`--carousel-index: ${index}`"
    >
        {{ $slot }}
    </div>
</{{ $as }}>
