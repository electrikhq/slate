{{-- avatar-fallback.blade.php --}}
@props([])

<div
    x-show="!imageLoaded || imageError"
    x-cloak
    {{ $attributes->merge([
        'class' => 'flex h-full w-full items-center justify-center rounded-full bg-muted'
    ]) }}
>
    {{ $slot }}
</div>

