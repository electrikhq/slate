@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="hover-card-trigger"
    class="inline-flex"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
