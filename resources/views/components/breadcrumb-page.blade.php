@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="breadcrumb-page"
    role="link"
    aria-disabled="true"
    aria-current="page"
    {{ $attributes->merge(['class' => 'font-normal text-foreground']) }}
>
    {{ $slot }}
</{{ $as }}>
