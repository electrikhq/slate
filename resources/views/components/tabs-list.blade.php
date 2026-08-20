@props([
    'variant' => 'default',
    'as' => 'div',
])

@php
    $resolvedVariant = in_array($variant, ['default', 'line'], true) ? $variant : 'default';

    $baseClasses = 'group/tabs-list inline-flex w-fit items-center justify-center rounded-lg p-[3px] text-muted-foreground group-data-[orientation=horizontal]/tabs:h-9 group-data-[orientation=vertical]/tabs:h-fit group-data-[orientation=vertical]/tabs:flex-col data-[variant=line]:rounded-none';

    $variantClasses = [
        'default' => 'bg-muted',
        'line' => 'gap-1 bg-transparent',
    ];

    $classes = trim(implode(' ', [
        $baseClasses,
        $variantClasses[$resolvedVariant],
    ]));
@endphp

<{{ $as }}
    data-slot="tabs-list"
    data-variant="{{ $resolvedVariant }}"
    role="tablist"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</{{ $as }}>
