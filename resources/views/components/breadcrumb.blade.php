{{-- breadcrumb.blade.php --}}
@props([])

<nav
    aria-label="Breadcrumb"
    {{ $attributes->merge(['class' => 'flex']) }}
>
    {{ $slot }}
</nav>

