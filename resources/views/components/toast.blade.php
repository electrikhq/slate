@props([
    'variant' => 'default',
    'title' => null,
    'description' => null,
    'as' => 'div',
])

@php
    $baseClasses = 'pointer-events-auto relative flex w-full items-start gap-3 overflow-hidden rounded-lg border bg-background p-4 pe-10 shadow-lg';

    $variantClasses = [
        'default' => 'border-border text-foreground',
        'destructive' => 'border-destructive/40 text-destructive *:data-[slot=toast-description]:text-destructive/90',
        'success' => 'border-success/40 text-success *:data-[slot=toast-description]:text-success/90',
        'warning' => 'border-warning/40 text-warning *:data-[slot=toast-description]:text-warning/90',
        'info' => 'border-info/40 text-info *:data-[slot=toast-description]:text-info/90',
    ];

    $resolvedVariant = array_key_exists($variant, $variantClasses) ? $variant : 'default';
    $composed = filled($title) || filled($description) || isset($action);
    $classes = trim($baseClasses.' '.($variantClasses[$resolvedVariant] ?? ''));
@endphp

<{{ $as }}
    data-slot="toast"
    role="status"
    aria-live="polite"
    data-variant="{{ $resolvedVariant }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($composed)
        <div class="grid flex-1 gap-0.5">
            @if(filled($title))
                <x-slate::toast-title>{{ $title }}</x-slate::toast-title>
            @endif
            @if(filled($description))
                <x-slate::toast-description>{{ $description }}</x-slate::toast-description>
            @endif
        </div>

        @isset($action)
            <x-slate::toast-action>{{ $action }}</x-slate::toast-action>
        @endisset

        {{ $slot }}

        <x-slate::toast-close />
    @else
        {{ $slot }}
    @endif
</{{ $as }}>
