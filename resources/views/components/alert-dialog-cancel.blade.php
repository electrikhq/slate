@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="alert-dialog-cancel"
    @click="open = false"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
