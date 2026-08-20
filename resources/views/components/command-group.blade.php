@props([
    'heading' => null,
    'as' => 'div',
])

@php
    $composed = filled($heading);
@endphp

<{{ $as }}
    data-slot="command-group"
    role="group"
    {{ $attributes->merge(['class' => 'overflow-hidden p-1 text-foreground']) }}
>
    @if($composed)
        <div class="px-2 py-1.5 text-xs font-medium text-muted-foreground">{{ $heading }}</div>
    @endif
    {{ $slot }}
</{{ $as }}>
