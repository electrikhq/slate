@props([
    'as' => 'nav',
])

<{{ $as }}
    data-slot="breadcrumb"
    aria-label="breadcrumb"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
