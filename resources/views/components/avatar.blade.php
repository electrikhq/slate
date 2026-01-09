{{-- avatar.blade.php --}}
@props([])

<div
    x-data="{ imageLoaded: false, imageError: false }"
    {{ $attributes->merge(['class' => 'relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full']) }}
>
    {{ $slot }}
</div>

