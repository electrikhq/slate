{{-- hover-card-trigger.blade.php --}}
@props([])

<div
    {{ $attributes->merge(['class' => 'inline-block']) }}
>
    {{ $slot }}
</div>

