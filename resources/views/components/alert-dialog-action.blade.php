{{-- alert-dialog-action.blade.php --}}
@props([
    'as' => 'button',
    'variant' => 'default', // default, danger
])

@php
    $variantClasses = match($variant) {
        'danger' => 'bg-danger text-danger-foreground hover:bg-danger/90',
        default => 'bg-primary text-primary-foreground hover:bg-primary/90',
    };
    
    $baseClasses = 'inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2';
    
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $variantClasses,
        $attributes->get('class'),
    ])));
@endphp

<{{ $as }}
    type="{{ $as === 'button' ? 'button' : '' }}"
    @click="close()"
    {{ $attributes->merge(['class' => $classes])->except(['variant']) }}
>
    {{ $slot }}
</{{ $as }}>

