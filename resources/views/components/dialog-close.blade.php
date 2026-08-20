@props([
    'as' => 'div',
    'type' => 'button',
])

<{{ $as }}
    data-slot="dialog-close"
    @if($as === 'button') type="{{ $type }}" @endif
    @click="open = false"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $as }}>
