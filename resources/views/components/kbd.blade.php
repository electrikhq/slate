{{-- kbd.blade.php --}}
@props([
    'size' => 'md', // sm, md, lg
])

@php
    $sizeClasses = [
        'sm' => 'px-1.5 py-0.5 text-xs',
        'md' => 'px-2 py-1 text-sm',
        'lg' => 'px-2.5 py-1.5 text-base',
    ][$size];
@endphp

<kbd
    {{ $attributes->merge([
        'class' => "inline-flex items-center rounded border border-border bg-muted px-2 py-1 font-mono text-sm font-semibold text-muted-foreground shadow-sm {$sizeClasses}"
    ]) }}
>
    {{ $slot }}
</kbd>

