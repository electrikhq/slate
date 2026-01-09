{{-- command-group.blade.php --}}
@props([
    'heading' => null,
])

@php
    $baseClasses = '[&_[cmdk-group-heading]]:px-2 [&_[cmdk-group-heading]]:py-1.5 [&_[cmdk-group-heading]]:text-xs [&_[cmdk-group-heading]]:font-medium [&_[cmdk-group-heading]]:text-muted-foreground [&_[cmdk-group]:not([hidden])_~[cmdk-group]]:pt-0 [&_[cmdk-group]]:px-2 [&_[cmdk-group]]:pb-1';
@endphp

<ul
    {{ $attributes->merge(['class' => $baseClasses]) }}
>
    @if($heading)
        <li class="px-2 py-1.5 text-xs font-medium text-muted-foreground">{{ $heading }}</li>
    @endif
    {{ $slot }}
</ul>

