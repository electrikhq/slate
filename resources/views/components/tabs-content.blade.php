@props([
    'value' => null,
    'as' => 'div',
])

@php
    $tabValue = (string) ($value ?? '');
@endphp

<{{ $as }}
    data-slot="tabs-content"
    role="tabpanel"
    data-value="{{ $tabValue }}"
    x-show="active === @js($tabValue)"
    x-cloak
    {{ $attributes->merge(['class' => 'flex-1 outline-none']) }}
>
    {{ $slot }}
</{{ $as }}>
