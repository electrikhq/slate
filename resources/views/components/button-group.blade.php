@props([
    'orientation' => 'horizontal',
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';

    $classes = $resolvedOrientation === 'vertical'
        ? 'flex flex-col items-stretch has-[>[data-slot=button]]:rounded-none [&>[data-slot=button]]:rounded-none [&>[data-slot=button]:first-child]:rounded-t-md [&>[data-slot=button]:last-child]:rounded-b-md [&>[data-slot=button]:not(:first-child)]:border-t-0'
        : 'inline-flex w-fit items-stretch has-[>[data-slot=button]]:rounded-none [&>[data-slot=button]]:rounded-none [&>[data-slot=button]:first-child]:rounded-s-md [&>[data-slot=button]:last-child]:rounded-e-md [&>[data-slot=button]:not(:first-child)]:border-s-0';
@endphp

<{{ $as }}
    data-slot="button-group"
    data-orientation="{{ $resolvedOrientation }}"
    role="group"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
