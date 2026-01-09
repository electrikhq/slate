{{-- calendar-header.blade.php --}}
@props([])

<div
    {{ $attributes->merge([
        'class' => 'flex items-center justify-between p-4'
    ]) }}
>
    {{ $slot }}
</div>

