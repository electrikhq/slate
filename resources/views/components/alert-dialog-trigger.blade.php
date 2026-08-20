@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="alert-dialog-trigger"
    @click="open = true"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
