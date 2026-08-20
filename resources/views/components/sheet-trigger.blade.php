@props([
    'as' => 'div',
])

<{{ $as }}
    data-slot="sheet-trigger"
    @click="open = true"
    {{ $attributes->merge(['class' => 'inline-flex']) }}
>
    {{ $slot }}
</{{ $as }}>
