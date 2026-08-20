@props([
    'value',
    'as' => 'div',
])

<{{ $as }}
    data-slot="accordion-item"
    data-value="{{ $value }}"
    x-bind:data-state="isOpen(@js((string) $value)) ? 'open' : 'closed'"
    {{ $attributes->merge(['class' => 'group/accordion-item border-b last:border-b-0']) }}
>
    {{ $slot }}
</{{ $as }}>
