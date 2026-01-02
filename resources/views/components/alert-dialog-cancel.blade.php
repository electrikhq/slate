{{-- alert-dialog-cancel.blade.php --}}
@props([
    'as' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 mt-3 sm:mt-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground';
    
    $classes = trim(implode(' ', array_filter([
        $baseClasses,
        $attributes->get('class'),
    ])));
@endphp

<{{ $as }}
    type="{{ $as === 'button' ? 'button' : '' }}"
    @click="close()"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot ?? 'Cancel' }}
</{{ $as }}>

