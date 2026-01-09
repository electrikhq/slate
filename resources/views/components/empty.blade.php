{{-- empty.blade.php --}}
@props([])

<div
    {{ $attributes->merge([
        'class' => 'flex flex-col items-center justify-center py-16 text-center'
    ]) }}
>
    {{ $slot }}
</div>

