@props([
    'as' => 'div',
    'title' => null,
])

@php
    $composed = filled($title);
@endphp

<{{ $as }}
    data-slot="timeline-title"
    {{ $attributes->merge(['class' => 'text-sm font-medium leading-none']) }}
>
    @if($composed)
        {{ $title }}
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
