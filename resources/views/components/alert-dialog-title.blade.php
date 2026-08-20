@props(['as' => 'h2'])

<{{ $as }}
    data-slot="alert-dialog-title"
    {{ $attributes->merge(['class' => 'text-lg font-semibold']) }}
>
    {{ $slot }}
</{{ $as }}>
