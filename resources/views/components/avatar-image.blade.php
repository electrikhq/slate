{{-- avatar-image.blade.php --}}
@props([
    'src' => null,
    'alt' => '',
])

@if($src)
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        x-show="!imageError"
        x-on:error="imageError = true; imageLoaded = false"
        x-on:load="imageLoaded = true; imageError = false"
        {{ $attributes->merge(['class' => 'aspect-square h-full w-full']) }}
    />
@endif

