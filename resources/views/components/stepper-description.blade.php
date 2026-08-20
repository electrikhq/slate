@props([
    'as' => 'div',
    'description' => null,
])

@php
    $composed = filled($description);
@endphp

<{{ $as }}
    data-slot="stepper-description"
    {{ $attributes->merge(['class' => 'text-sm text-muted-foreground']) }}
>
    @if($composed)
        {{ $description }}
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
