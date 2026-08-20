@props([
    'orientation' => 'horizontal',
    'decorative' => true,
    'as' => 'div',
])

@php
    $resolvedOrientation = in_array($orientation, ['horizontal', 'vertical'], true)
        ? $orientation
        : 'horizontal';

    $isDecorative = filter_var($decorative, FILTER_VALIDATE_BOOL);

    $classes = 'shrink-0 bg-border data-[orientation=horizontal]:h-px data-[orientation=horizontal]:w-full data-[orientation=vertical]:h-full data-[orientation=vertical]:w-px';
@endphp

<{{ $as }}
    data-slot="separator"
    data-orientation="{{ $resolvedOrientation }}"
    @if($isDecorative)
        role="none"
        aria-hidden="true"
    @else
        role="separator"
        aria-orientation="{{ $resolvedOrientation }}"
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
></{{ $as }}>
