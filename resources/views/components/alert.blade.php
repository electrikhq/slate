@props([
    'variant' => 'default',
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $baseClasses = 'relative grid w-full grid-cols-[0_1fr] items-start gap-y-0.5 rounded-lg border px-4 py-3 text-sm has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] has-[>svg]:gap-x-3 [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current has-data-[slot=alert-action]:pe-24';

    $variantClasses = [
        'default' => 'bg-card text-card-foreground',
        'destructive' => 'bg-card text-destructive *:data-[slot=alert-description]:text-destructive/90 [&>svg]:text-current',
        'success' => 'bg-card text-success *:data-[slot=alert-description]:text-success/90 [&>svg]:text-current',
        'warning' => 'bg-card text-warning *:data-[slot=alert-description]:text-warning/90 [&>svg]:text-current',
        'info' => 'bg-card text-info *:data-[slot=alert-description]:text-info/90 [&>svg]:text-current',
    ];

    $resolvedVariant = array_key_exists($variant, $variantClasses) ? $variant : 'default';

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$resolvedVariant],
    ]));

    $composed = filled($title) || filled($description) || isset($action);
@endphp

<{{ $as }}
    data-slot="alert"
    role="alert"
    data-variant="{{ $resolvedVariant }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($composed)
        {{ $slot }}

        @if(filled($title))
            <x-slate::alert-title>{{ $title }}</x-slate::alert-title>
        @endif

        @if(filled($description))
            <x-slate::alert-description>{{ $description }}</x-slate::alert-description>
        @endif

        @isset($action)
            <x-slate::alert-action>{{ $action }}</x-slate::alert-action>
        @endisset
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
