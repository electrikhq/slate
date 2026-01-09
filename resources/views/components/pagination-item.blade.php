{{-- pagination-item.blade.php --}}
@props([])

<li
    {{ $attributes->merge(['class' => '']) }}
>
    {{ $slot }}
</li>

