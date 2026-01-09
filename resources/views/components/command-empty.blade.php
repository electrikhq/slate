{{-- command-empty.blade.php --}}
@props([])

<div
    {{ $attributes->merge(['class' => 'py-6 text-center text-sm']) }}
>
    {{ $slot }}
</div>

