@props([
    'as' => 'span',
])

<{{ $as }}
    data-slot="sheet-close"
    @click="open = false"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
