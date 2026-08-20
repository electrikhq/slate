@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="alert-dialog-action"
    @click="open = false"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
