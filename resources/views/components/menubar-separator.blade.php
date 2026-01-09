{{-- menubar-separator.blade.php --}}
@props([])

<div
    role="separator"
    {{ $attributes->merge(['class' => '-mx-1 my-1 h-px bg-border']) }}
></div>

