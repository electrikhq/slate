{{-- breadcrumb-item.blade.php --}}
@props([])

<li
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5']) }}
>
    {{ $slot }}
</li>

